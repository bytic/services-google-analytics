<?php

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;

/**
 * Trait HasTrackers
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 */
trait HasTrackers
{
    protected $trackers = [];

    /**
     * @param $key
     * @return null
     */
    public function getTracker($key)
    {
        return $this->hasTracker($key) ? $this->trackers[$key] : null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasTracker($key)
    {
        return isset($this->trackers[$key]);
    }

    /**
     * @param $tracker
     * @param $key
     */
    public function addTracker($tracker, $key)
    {
        $tracker = $tracker instanceof Tracker ? $tracker : $this->newTracker($tracker);
        $this->trackers[$key] = $tracker;
    }

    /**
     * @param $trackingId
     * @return Tracker
     */
    public function newTracker($trackingId)
    {
        $tracker = new Tracker($trackingId);
        return $tracker;
    }
}
