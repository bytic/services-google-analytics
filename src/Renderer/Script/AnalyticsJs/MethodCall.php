<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class MethodCall
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs
 */
class MethodCall
{
    /**
     * @param string $functionName
     * @param array $params
     * @return string
     */
    public static function generate($params, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $jsArray = json_encode($params);
        $jsArrayAsParams = substr($jsArray, 1, -1);
        $output = sprintf("\n" . '%s(%s);', $functionName, $jsArrayAsParams);

        return $output;
    }
}
