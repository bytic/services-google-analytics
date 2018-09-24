<?php

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics;

/**
 * Trait HasTrackerFunctions
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 *
 * @method Tracker autoInitTracker($key)
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

    /**
     * @param Transaction $transaction
     * @param string $trackerKey
     */
    public function addTransaction($transaction, $trackerKey = GoogleAnalytics::TRACKER_DEFAULT_KEY)
    {
        $tracker = $this->autoInitTracker($trackerKey);
        $tracker->addTransaction($transaction);
    }
}
