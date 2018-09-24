<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;

/**
 * Class AnalyticsJs
 * @package ByTIC\GoogleAnalytics\Tracking
 */
class AnalyticsJs extends AbstractScript
{
    const DEFAULT_FUNCTION_NAME = 'ga';

    protected $function = self::DEFAULT_FUNCTION_NAME;

    /**
     * @return string
     */
    protected function generateCode()
    {
        $script = $this->generateLoadScript();

        $trackers = $this->getGoogleAnalytics()->getTrackers();

        foreach ($trackers as $alias => $tracker) {
            $script .= $this->generateTrackerCode($tracker, $alias);
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
     * @param string $alias
     * @return string
     */
    protected function generateTrackerCode($tracker, $alias)
    {
        $parameters = [];
        $params     = [
            'create',
            $tracker->getTrackingId(),
        ];


        if ($tracker->isAllowLinker()) {
            $parameters['allowLinker'] = true;
        }

        if ($tracker->isAnonymizeIp()) {
            $parameters['anonymizeIp'] = true;
        }

        if (count($parameters) > 0) {
            $params[] = $parameters;
        }

        return $this->callGa($params);
    }

    /**
     * @param array $params
     * @return string
     */
    protected function callGa(array $params)
    {
        $jsArray = json_encode($params);
        $jsArrayAsParams = substr($jsArray, 1, -1);
        $output = sprintf("\n" . '%s(%s);', $this->getFunctionName(), $jsArrayAsParams);

        return $output;
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
}