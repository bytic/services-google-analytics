<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class RequireCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs
 */
class RequireCommand
{
    /**
     * @param Tracker $tracker
     * @param string $functionName
     * @return string
     */
    public static function generate(
        $tracker,
        $pluginName,
        $pluginOptions = null,
        $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME
    ) {
        $params = [
            $tracker->getCommandAlias() . 'require',
            $pluginName,
        ];

        return MethodCall::generate($params, $functionName);
    }
}
