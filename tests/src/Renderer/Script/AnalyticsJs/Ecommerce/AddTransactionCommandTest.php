<?php

namespace ByTIC\GoogleAnalytics\Tests\Renderer\Script\AnalyticsJs\Ecommerce;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\AddTransactionCommand;

/**
 * Class AddTransactionCommandTest
 * @package ByTIC\GoogleAnalytics\Tests\Renderer\Script\AnalyticsJs\Ecommerce
 */
class AddTransactionCommandTest extends AbstractTest
{

    public function testGenerateEmptyTracker()
    {
        $tracker = new Tracker();
        $transaction = Transaction::createFromArray(['id' => 1]);

        self::assertSame(
            "\n" . 'ga("ecommerce:addTransaction",{"id":1});',
            AddTransactionCommand::generate($tracker, $transaction)
        );
    }

    public function testGenerateFullTracker()
    {
        $tracker = new Tracker();
        $transaction = Transaction::createFromArray(
            [
                'id' => 1,
                'affiliation' => 'Acme Clothing',
                'revenue' => 99.99,
                'shipping' => 9.99,
                'tax' => 19.99,
                'currency' => 'RON',
            ]
        );

        self::assertSame(
            "\n"
            . 'ga("ecommerce:addTransaction",'
            . '{"id":1,"affiliation":"Acme Clothing","revenue":99.99,"shipping":9.99,"tax":19.99,"currency":"RON"});',
            AddTransactionCommand::generate($tracker, $transaction)
        );
    }
}
