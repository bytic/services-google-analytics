<?php

namespace ByTIC\GoogleAnalytics\Tracking\Data;

use ByTIC\GoogleAnalytics\Tracking\Data\Tracker\HasTransactionsTrait;

/**
 * Class Tracker
 * @package ByTIC\GoogleAnalytics\Tracking\Data
 */
class Tracker
{
    use HasTransactionsTrait;

    /**
     * Web property ID for Google Analytics
     *
     * @var string
     */
    protected $trackingId;

    protected $alias;

    protected $enableTracking = true;

    protected $allowLinker = false;
    protected $anonymizeIp = false;

    protected $domainName;

    /**
     * Tracker constructor.
     * @param string $trackingId
     */
    public function __construct($trackingId = null)
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
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return mixed
     */
    public function getCommandAlias()
    {
        return empty($this->alias) ? '' : $this->alias . '.';
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return !empty($this->trackingId) && $this->enableTracking;
    }

    /**
     * @param bool $enableTracking
     */
    public function setEnabled(bool $enableTracking)
    {
        $this->enableTracking = $enableTracking;
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

    /**
     * @return bool
     */
    public function isAnonymizeIp(): bool
    {
        return $this->anonymizeIp;
    }

    /**
     * @param bool $anonymizeIp
     */
    public function setAnonymizeIp(bool $anonymizeIp)
    {
        $this->anonymizeIp = $anonymizeIp;
    }
}
