<?php
declare(strict_types=1);

namespace ByTIC\GoogleAnalytics\Tracking\Traits;

use ByTIC\GoogleAnalytics\Tracking\Renderer\Renderer;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsFour;

/**
 * Trait HasRenderer
 * @package ByTIC\GoogleAnalytics\Tracking\Traits
 */
trait HasRenderer
{
    protected $script = Renderer::DEFAULT_RENDERER;

    /**
     * @param $script
     * @return void
     */
    public function setRenderer($script)
    {
        $this->script = $script;
    }

    /**
     * @return string
     */
    public function generateCode()
    {
        return Renderer::render($this, $this->script);
    }
}
