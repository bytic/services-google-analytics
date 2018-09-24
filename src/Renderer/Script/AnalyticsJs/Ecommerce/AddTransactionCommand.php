<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\MethodCall;

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
        $transactionParams = [
            'id' => $transaction->getId(),
        ];

        $affiliation = $transaction->getAffiliation();
        if ($affiliation !== null) {
            $transactionParams['affiliation'] = $affiliation;
        }

        $revenue = $transaction->getRevenue();
        if ($revenue !== null) {
            $transactionParams['revenue'] = $revenue;
        }

        $shipping = $transaction->getShipping();
        if ($shipping !== null) {
            $transactionParams['shipping'] = $shipping;
        }

        $tax = $transaction->getTax();
        if ($tax !== null) {
            $transactionParams['tax'] = $tax;
        }

        $params = [
            $tracker->getAlias() . '.ecommerce:addTransaction',
            $transactionParams,
        ];

        return MethodCall::generate($params, $functionName);
    }
}
