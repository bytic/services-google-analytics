<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script;

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
        $script = $this->getLoadScript();

        return $script;
    }

    /**
     * @return string
     */
    protected function getLoadScript()
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