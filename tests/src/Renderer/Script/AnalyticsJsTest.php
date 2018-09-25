<?php

namespace ByTIC\GoogleAnalytics\Tests\Renderer\Script;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Item;
use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class AnalyticsJsTest
 * @package ByTIC\GoogleAnalytics\Tests
 */
class AnalyticsJsTest extends AbstractTest
{

    public function testRunEmpty()
    {
        $script = $this->initScript();

        self::assertSame(
            '',
            $script->render()
        );
    }

    public function testGenerateBasic()
    {
        $script = $this->initScript();
        $script->getGoogleAnalytics()->setTrackingId('UA-9999999-9');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/codes/analytics/basic.html'),
            $script->render()
        );
    }

    public function testGenerateBasicTwoTrackers()
    {
        $script = $this->initScript();
        $script->getGoogleAnalytics()->setTrackingId('UA-9999999-9');
        $script->getGoogleAnalytics()->setTrackingId('UA-9999999-8', 'b');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/codes/analytics/basicTwoTrackers.html'),
            $script->render()
        );
    }

    public function testGenerateWithTransaction()
    {
        $script = $this->initScript();
        $script->getGoogleAnalytics()->setTrackingId('UA-9999999-8', 'b');

        $transaction = Transaction::createFromArray(['id' => '999']);
        $item = Item::createFromArray(['transactionId' => '999', 'name' => 'Test Product']);
        $transaction->addItem($item);

        $script->getGoogleAnalytics()->addTransaction($transaction, 'b');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/codes/analytics/ecommerce/basicTransaction.html'),
            $script->render()
        );
    }

    public function testMultipleTransactionsAndTrackers()
    {
        $script = $this->initScript();
        $ga = $script->getGoogleAnalytics();

        $ga->setTrackingId('UA-99999-1');
        $ga->setTrackingId('UA-99999-2', 't2');

        $transaction = Transaction::createFromArray(['id' => '999']);
        $item = Item::createFromArray(['transactionId' => '999', 'name' => 'Test Product']);
        $transaction->addItem($item);

        $ga->addTransaction($transaction);
        $ga->addTransaction($transaction, 't2');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/codes/analytics/ecommerce/multipleTransactionsAndTrackers.html'),
            $script->render()
        );
    }

    /**
     * @return AnalyticsJs
     */
    protected function initScript()
    {
        $ga = new \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics();

        $script = new AnalyticsJs();
        $script->setGoogleAnalytics($ga);
        return $script;
    }
}
