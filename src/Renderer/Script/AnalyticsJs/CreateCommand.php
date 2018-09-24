<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Class CreateCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs
 */
class CreateCommand
{

    /**
     * @param Tracker $tracker
     * @param $functionName
     * @return string
     */
    public static function generate($tracker, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $parameters = [];
        $params = [
            'create',
            $tracker->getTrackingId(),
            'auto'
        ];

        if ($tracker->getAlias()) {
            $params[] = $tracker->getAlias();
        }

        if ($tracker->isAllowLinker()) {
            $parameters['allowLinker'] = true;
        }

        if ($tracker->isAnonymizeIp()) {
            $parameters['anonymizeIp'] = true;
        }

        if (count($parameters) > 0) {
            $params[] = $parameters;
        }

        return MethodCall::generate($params, $functionName);
    }
}
