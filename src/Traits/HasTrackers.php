<?php

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;

/**
 * Trait HasTrackers
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 */
trait HasTrackers
{
    /**
     * @var Tracker[]
     */
    protected $trackers = [];

    /**
     * @return Tracker[]
     */
    public function getTrackers(): array
    {
        return $this->trackers;
    }

    /**
     * @param $key
     * @return null
     */
    public function getTracker($key)
    {
        return $this->hasTracker($key) ? $this->trackers[$key] : null;
    }

    /**
     * @param string $key
     * @return Tracker
     */
    protected function autoInitTracker($key)
    {
        if (!$this->hasTracker($key)) {
            $this->addTracker(false, $key);
        }
        return $this->getTracker($key);
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
     * @return bool
     */
    public function hasActiveTrackers()
    {
        foreach ($this->trackers as $tracker) {
            if ($tracker->isEnabled()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $tracker
     * @param $key
     */
    public function addTracker($tracker, $key)
    {
        $tracker = $tracker instanceof Tracker ? $tracker : $this->newTracker($tracker);
        $tracker->setAlias($key);
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
