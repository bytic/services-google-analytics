<?php

namespace ByTIC\GoogleAnalytics\Tests;

/**
 * Class GoogleAnalytics
 * @package ByTIC\GoogleAnalytics\Tests
 */
class GoogleAnalyticsTest extends AbstractTest
{

    public function testRunEmpty()
    {
        $ga = new \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics();

        self::assertSame(
            '',
            $ga->generateCode()
        );
    }

    public function testGenerateBasic()
    {
        $ga = new \ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics();
        $ga->setTrackingId('UA-9999999-9');

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH.'\codes\analytics\basic.html'),
            $ga->generateCode()
        );
    }

}
