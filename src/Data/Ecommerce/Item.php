<?php

namespace ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce;

/**
 * Class Transaction
 * @package ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce
 */
class Item
{
    /**
     * @var string The transaction ID. This ID is what links items to the transactions to which they belong. (e.g. 1234)
     */
    protected $transactionId;

    /**
     * @var string The item name. (e.g. Fluffy Pink Bunnies)
     */
    protected $name;

    /**
     * @var string Specifies the SKU or item code. (e.g. SKU47)
     */
    protected $sku;

    /**
     * @var string The category to which the item belongs (e.g. Party Toys)
     */
    protected $category;

    /**
     * @var float The individual, unit, price for each item. (e.g. 11.99)
     */
    protected $price;

    /**
     * @var int The number of units purchased in the transaction.
     * If a non-integer value is passed into this field (e.g. 1.5), it will be rounded to the closest integer value.
     */
    protected $quantity;

    /**
     * @param $params
     * @return static
     */
    public static function createFromArray($params)
    {
        $transaction = new static();
        $transaction->populateFromParams($params);
        return $transaction;
    }

    /**
     * @param $params
     */
    public function populateFromParams($params)
    {
        foreach ($params as $key => $param) {
            if (property_exists($this, $key)) {
                $this->{$key} = $param;
            }
        }
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId(string $transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}
