<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\MethodCall;
use InvalidArgumentException;

/**
 * Class AddTransactionCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce
 */
class AddTransactionCommand
{

    /**
     * @param Tracker $tracker
     * @param Transaction $transaction
     * @param $functionName
     * @return string
     */
    public static function generate($tracker, $transaction, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $transactionId = $transaction->getId();
        if (empty($transactionId)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Cannot add transaction without id'
                )
            );
        }
        $transactionParams = [
            'id' => $transaction->getId(),
        ];

        $transactionParams = static::checkOptionalParams($transaction, $transactionParams);

        $params = [
            $tracker->getCommandAlias() . 'ecommerce:addTransaction',
            $transactionParams,
        ];

        return MethodCall::generate($params, $functionName);
    }

    /**
     * @param $transaction
     * @param array $params
     * @return array|mixed
     */
    protected static function checkOptionalParams($transaction, $params = [])
    {
        $paramsLabels = ['affiliation', 'revenue', 'shipping', 'tax', 'currency'];
        foreach ($paramsLabels as $paramName) {
            $params = static::addParam($transaction, $paramName, $params);
        }
        return $params;
    }

    /**
     * @param $transaction
     * @param $paramName
     * @param $params
     * @return mixed
     */
    protected static function addParam($transaction, $paramName, $params = [])
    {
        $functionName = 'get' . ucfirst($paramName);
        $value = $transaction->$functionName();
        if ($value !== null) {
            $params[$paramName] = $value;
        }
        return $params;
    }
}
