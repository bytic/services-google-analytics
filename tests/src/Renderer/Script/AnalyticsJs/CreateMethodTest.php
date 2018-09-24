<?php

namespace ByTIC\GoogleAnalytics\Tests\Renderer\Script\AnalyticsJs;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\CreateCommand;

/**
 * Class CreateMethodTest
 * @package ByTIC\GoogleAnalytics\Tests\Renderer\Script\AnalyticsJs
 */
class CreateMethodTest extends AbstractTest
{
    public function testGenerateEmptyTracker()
    {
        $tracker = new Tracker();

        self::assertSame(
            "\n" . 'ga("create",null,"auto");',
            CreateCommand::generate($tracker)
        );
    }

    public function testGenerateAliasTracker()
    {
        $tracker = new Tracker();
        $tracker->setTrackingId('UA-XXXXX-Y');
        $tracker->setAlias('myTracker');

        self::assertSame(
            "\n" . 'ga("create","UA-XXXXX-Y","auto","myTracker");',
            CreateCommand::generate($tracker)
        );
    }

    public function testGenerateAllowLinkerTracker()
    {
        $tracker = new Tracker();
        $tracker->setTrackingId('UA-XXXXX-Y');
        $tracker->setAlias('myTracker');
        $tracker->setAllowLinker(true);

        self::assertSame(
            "\n" . 'ga("create","UA-XXXXX-Y","auto","myTracker",{"allowLinker":true});',
            CreateCommand::generate($tracker)
        );
    }
}
