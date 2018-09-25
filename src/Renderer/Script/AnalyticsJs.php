<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\CreateCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\AddItemCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\AddTransactionCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce\SendCommand as EcommerceSendCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\RequireCommand;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\SendCommand;

/**
 * Class AnalyticsJs
 * @package ByTIC\GoogleAnalytics\Tracking
 */
class AnalyticsJs extends AbstractScript
{
    const DEFAULT_FUNCTION_NAME = 'ga';

    protected $function = self::DEFAULT_FUNCTION_NAME;

    protected $loadedPlugins = [];

    /**
     * @return string
     */
    protected function generateCode()
    {
        $script = $this->generateLoadScript();

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
        $script = <<<SCRIPT
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','%s');
SCRIPT;

        return sprintf($script, $this->getFunctionName());
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateCreateTracker($tracker)
    {
        return CreateCommand::generate($tracker, $this->getFunctionName());
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateTransactions($tracker)
    {
        $transactions = $tracker->getTransactions();
        $hasTransactions = count($transactions) > 0;

        if (!$hasTransactions) {
            return '';
        }
        $output = $this->requirePlugin($tracker, 'ecommerce');

        foreach ($transactions as $transaction) {
            $output .= AddTransactionCommand::generate($tracker, $transaction, $this->getFunctionName());
            $items = $transaction->getItems();
            foreach ($items as $item) {
                $output .= AddItemCommand::generate($tracker, $item, $this->getFunctionName());
            }
        }
        $output .= EcommerceSendCommand::generate($tracker, $this->getFunctionName());

        return $output;
    }

    /**
     * @param Tracker $tracker
     * @return string
     */
    protected function generateSend($tracker)
    {
        return SendCommand::generate($tracker, $this->getFunctionName());
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
}
