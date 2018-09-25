<?php

namespace ByTIC\GoogleAnalytics\Tests\Traits;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics;

/**
 * Class HasTrackerFunctionsTest
 * @package ByTIC\GoogleAnalytics\Tests\Traits
 */
class HasTrackerFunctionsTest extends AbstractTest
{
    public function testSetAllowLinker()
    {
        $ga = new GoogleAnalytics();
        $tracker = new Tracker();
        $ga->addTracker($tracker, 'test');

        static::assertFalse($tracker->isAllowLinker());

        $ga->setAllowLinker(true, 'test');
        static::assertTrue($tracker->isAllowLinker());
    }

    public function testMultipleTransactionsAndTrackers()
    {
        $ga = new GoogleAnalytics();
        $ga->setTrackingId('UA-99999-1', 't1');
        $ga->setTrackingId('UA-99999-2', 't2');

        $transaction = Transaction::createFromArray([
            'id' => '82604',
            'revenue' => 100,
            'tax' => 0,
            'shipping' => 0,
            'currency' => 'RON',
            'items' =>
                [
                    [
                        'transactionId' => '82604',
                        'sku' => '1659-2111',
                        'name' => 'Masculin 18-34 ani - Cros 10.8 km',
                        'category' => 'Semimaraton Gerar ~ 2017',
                        'price' => 100,
                        'quantity' => 1,
                    ]
                ]
        ]);

        $ga->addTransaction($transaction, 't1');
        $ga->addTransaction($transaction, 't2');

        foreach (['t1', 't2'] as $key) {
            $transactions = $ga->getTracker($key)->getTransactions();
            static::assertCount(1, $transactions);

            $items = $transactions[82604]->getItems();
            static::assertCount(1, $items);
        }
    }
}
