<?php

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics;

/**
 * Trait HasTrackerFunctions
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 */
trait HasTrackerFunctions
{
    /**
     * @param $id
     * @param string $trackerKey
     */
    public function setTrackingId($id, $trackerKey = GoogleAnalytics::TRACKER_DEFAULT_KEY)
    {
        $tracker = $this->autoInitTracker($trackerKey);
        $tracker->setTrackingId($id);
    }
}
