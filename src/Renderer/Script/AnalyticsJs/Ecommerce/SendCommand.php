<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Item;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\MethodCall;

/**
 * Class SendCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce
 */
class SendCommand
{

    /**
     * @param Tracker $tracker
     * @param Item $item
     * @param $functionName
     * @return string
     */
    public static function generate($tracker, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $params = [
            $tracker->getCommandAlias() . 'ecommerce:send'
        ];

        return MethodCall::generate($params, $functionName);
    }
}
