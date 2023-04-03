<?php
declare(strict_types=1);

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\CreateCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\AddItemCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\AddTransactionCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\SendCommand as EcommerceSendCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\MethodCall;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\RequireCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\SendCommand;

/**
 * Class AnalyticsFour
 * @package ByTIC\GoogleAnalytics\Tracking
 */
class AnalyticsFour extends AbstractScript
{
    const DEFAULT_FUNCTION_NAME = 'gtag';

    protected $function = self::DEFAULT_FUNCTION_NAME;

    protected $loadedPlugins = [];

    /**
     * @return string
     */
    protected function generateCode()
    {
        $script = <<<SCRIPT
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

SCRIPT;

        $trackers = $this->getGoogleAnalytics()->getTrackers();

        foreach ($trackers as $alias => $tracker) {
            if ($tracker->isEnabled()) {
                $script .= $this->generateCreateTracker($tracker);
                $script .= $this->generateTransactions($tracker);
                $script .= $this->generateSend($tracker);
            }
        }

        return $script;
    }

    /**
     * @return string
     */
    protected function generateLoadScript()
    {
        $return = '';
        $trackers = $this->getGoogleAnalytics()->getTrackers();
        foreach ($trackers as $alias => $tracker) {
            $return .= '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $tracker->getTrackingId() . '"></script>' . "\n";
        }
        return $return;
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateCreateTracker($tracker)
    {
        return MethodCall::generate(['config', $tracker->getTrackingId()], $this->getFunctionName());
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateTransactions($tracker)
    {
        return '';
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateSend($tracker)
    {
        return '';
    }

    /**
     * @param $name
     */
    public function setFunctionName($name)
    {
        $this->function = $name;
    }

    /**
     * @return string
     */
    public function getFunctionName()
    {
        return $this->function;
    }

    /**
     * @param Tracker $tracker
     * @param $name
     * @return string
     */
    protected function requirePlugin($tracker, $name)
    {
        if (isset($this->loadedPlugins[$tracker->getAlias()][$name])) {
            return '';
        }

        $params = [];

        $output = RequireCommand::generate($tracker, $name, $params, $this->getFunctionName());
        $this->loadedPlugins[$tracker->getAlias()][$name] = true;
        return $output;
    }

    public function render()
    {
        // Do not render when tracker is disabled
        if (!$this->googleAnalytics->hasActiveTrackers()) {
            return '';
        }

        $script = $this->generateLoadScript() . "\n";
        $script .= '<script>' . "\n"
            . $this->generateCode() . "\n"
            . '</script>';
        return $script;
    }
}
