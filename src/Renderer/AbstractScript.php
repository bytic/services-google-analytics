<?php

namespace ByTIC\GoogleAnalytics\Tracking;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;

/**
 * Class AbstractScript
 * @package ByTIC\GoogleAnalytics\Tracking
 */
abstract class AbstractScript
{
    /**
     * @var Tracker
     */
    protected $tracker;

    public function render()
    {

        // Do not render when tracker is disabled
        if (!$this->tracker->enabled()) {
            return;
        }
    }

    /**
     * @return Tracker
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @param Tracker $tracker
     */
    public function setTracker($tracker)
    {
        $this->tracker = $tracker;
    }
}
