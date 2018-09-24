<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class SendCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs
 */
class SendCommand
{
    /**
     * @param Tracker $tracker
     * @param string $functionName
     * @return string
     */
    public static function generate($tracker, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $parameters = [];
        $params = [
            $tracker->getAlias() . '.send',
            'pageview',
        ];

        return MethodCall::generate($params, $functionName);
    }
}
