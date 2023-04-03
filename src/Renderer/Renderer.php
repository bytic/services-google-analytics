<?php
declare(strict_types=1);

namespace ByTIC\GoogleAnalytics\Tracking\Renderer;

use ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsFour;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AbstractScript;
use ByTIC\GoogleAnalytics\Tracking\Traits\HasRenderer;

/**
 * Class Renderer
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer
 */
class Renderer
{
    const DEFAULT_RENDERER = 'AnalyticsJs';
    const GA4_RENDERER = 'Ga4';

    /**
     * @param GoogleAnalytics|HasRenderer $analytics
     * @param string $name
     * @return string
     */
    public static function render($analytics, $name = SELF::DEFAULT_RENDERER)
    {
        $script = self::newScript($analytics, $name);
        return $script->render();
    }

    /**
     * @param string $name
     * @param GoogleAnalytics $analytics
     * @return AbstractScript
     */
    protected static function newScript($analytics, $name)
    {
        $class = '\ByTIC\GoogleAnalytics\Tracking\Renderer\Script\\' . $name;
        /** @var AbstractScript $script */
        $script = new $class();
        $script->setGoogleAnalytics($analytics);
        return $script;
    }
}