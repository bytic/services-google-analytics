<?php

namespace ByTIC\GoogleAnalytics\Tests\Traits;

use ByTIC\GoogleAnalytics\Tests\AbstractTest;
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
}
