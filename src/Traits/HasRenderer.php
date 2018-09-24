<?php

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\Renderer\Renderer;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;

/**
 * Trait HasRenderer
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 */
trait HasRenderer
{
    protected $script = Renderer::DEFAULT_RENDERER;

    /**
     * @return string
     */
    public function generateCode()
    {
        return Renderer::render($this, $this->script);
    }
}
