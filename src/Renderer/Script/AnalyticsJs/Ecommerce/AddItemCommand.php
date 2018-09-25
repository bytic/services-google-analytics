<?php

namespace ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Item;
use ByTIC\GoogleAnalytics\Tracking\Data\Tracker;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs;
use ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\MethodCall;

/**
 * Class AddItemCommand
 * @package ByTIC\GoogleAnalytics\Tracking\Renderer\Script\AnalyticsJs\Ecommerce
 */
class AddItemCommand
{

    /**
     * @param Tracker $tracker
     * @param Item $item
     * @param $functionName
     * @return string
     */
    public static function generate($tracker, $item, $functionName = AnalyticsJs::DEFAULT_FUNCTION_NAME)
    {
        $itemParams = [
            'id'   => $item->getTransactionId(),
            'name' => $item->getName(),
        ];

        $sku = $item->getSku();
        if ($sku !== null) {
            $itemParams['sku'] = $sku;
        }

        $category = $item->getCategory();
        if ($category !== null) {
            $itemParams['category'] = $category;
        }

        $price = $item->getPrice();
        if ($price !== null) {
            $itemParams['price'] = $price;
        }

        $quantity = $item->getQuantity();
        if ($quantity !== null) {
            $itemParams['quantity'] = $quantity;
        }

        $params = [
            $tracker->getCommandAlias() . 'ecommerce:addItem',
            $itemParams,
        ];

        return MethodCall::generate($params, $functionName);
    }
}
