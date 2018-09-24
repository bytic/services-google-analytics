<?php

namespace ByTIC\GoogleAnalytics\Tracking\Models;

/**
 * Class Tracker
 * @package ByTIC\GoogleAnalytics\Tracking\Models
 */
class Tracker
{

    /**
     * Web property ID for Google Analytics
     *
     * @var string
     */
    protected $trackingId;

    protected $allowLinker = false;

    protected $domainName;

    protected $transactions = [];

    /**
     * Tracker constructor.
     * @param string $trackingId
     */
    public function __construct($trackingId)
    {
        $this->trackingId = $trackingId;
    }

    /**
     * @return string
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * @param string $trackingId
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = $trackingId;
    }

    /**
     * @param $allow_linker
     */
    public function setAllowLinker($allow_linker)
    {
        $this->allowLinker = (bool)$allow_linker;
    }

    /**
     * @return bool
     */
    public function isAllowLinker()
    {
        return $this->allowLinker;
    }

    /**
     * @param $domain_name
     */
    public function setDomainName($domain_name)
    {
        $this->domainName = (string)$domain_name;
    }

    /**
     * @return mixed
     */
    public function getDomainName()
    {
        return $this->domainName;
    }
}
