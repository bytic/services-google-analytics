<?php

namespace ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce;

/**
 * Class Transaction
 * @package ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce
 */
class Transaction
{
    /**
     * @var string The transaction ID. (e.g. 1234) Required
     */
    protected $id;

    /**
     * @var string The store or affiliation from which this transaction occurred (e.g. Acme Clothing).
     */
    protected $affiliation;

    /**
     * @var float Specifies the total revenue or grand total associated with the transaction (e.g. 11.99).
     */
    protected $revenue;

    /**
     * @var float Specifies the total shipping cost of the transaction. (e.g. 5)
     */
    protected $shipping;

    /**
     * @var float Specifies the total tax of the transaction. (e.g. 1.29)
     */
    protected $tax;

    /**
     * @var  string The local currency must be specified in the ISO 4217 standard.
     */
    protected $currency;

    /**
     * @var Item[]
     */
    protected $items = [];

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
            if ($key == 'items' && is_array($param)) {
                foreach ($param as $item) {

                }
            } elseif (property_exists($this, $key)) {
                $this->{$key} = $param;
            }
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }

    /**
     * @param string $affiliation
     */
    public function setAffiliation(string $affiliation)
    {
        $this->affiliation = $affiliation;
    }

    /**
     * @return float
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * @param float $revenue
     */
    public function setRevenue(float $revenue)
    {
        $this->revenue = $revenue;
    }

    /**
     * @return float
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param float $shipping
     */
    public function setShipping(float $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $params
     */
    public function addItemFromArray(array $params)
    {
        $item = Item::createFromArray($params);
        $this->addItem($item);
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $item->setTransactionId($this->getId());
        $sku = $item->getSku();
        if ($sku) {
            $this->items[$sku] = $item;
        } else {
            $this->items[] = $item;
        }
    }
}
