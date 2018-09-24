<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script;

use ByTIC\GoogleAnalytics\Tracking\GoogleAnalytics;

/**
 * Class AbstractScript
 * @package ByTIC\GoogleAnalytics\Tracking
 */
abstract class AbstractScript
{
    /**
     * @var GoogleAnalytics
     */
    protected $googleAnalytics;

    /**
     * @return string
     */
    public function render()
    {
        // Do not render when tracker is disabled
        if (!$this->googleAnalytics->hasActiveTrackers()) {
            return '';
        }

        return $this->generateCode();
    }

    protected abstract function generateCode();

    /**
     * @return GoogleAnalytics
     */
    public function getGoogleAnalytics()
    {
        return $this->googleAnalytics;
    }

    /**
     * @param GoogleAnalytics $googleAnalytics
     */
    public function setGoogleAnalytics($googleAnalytics)
    {
        $this->googleAnalytics = $googleAnalytics;
    }
}
