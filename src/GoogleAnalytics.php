<?php

namespace ByTIC\GoogleAnalytics\Tracking;

/**
 * Class GoogleAnalytics
 * @package ByTIC\GoogleAnalytics\Tracking
 */
class GoogleAnalytics
{
    use Traits\HasTrackers;
    use Traits\HasTrackerFunctions;
    use Traits\HasRenderer;

    const TRACKER_DEFAULT_KEY = 'gat';
}
