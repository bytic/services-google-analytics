<?php

namespace ByTIC\GoogleAnalytics\Tracking\Data\Tracker;

use ByTIC\GoogleAnalytics\Tracking\Data\Ecommerce\Transaction;
use InvalidArgumentException;

/**
 * Trait HasTransactionsTrait
 * @package ByTIC\GoogleAnalytics\Tracking\Data\Tracker
 */
trait HasTransactionsTrait
{
    /**
     * @var Transaction[]
     */
    protected $transactions = [];

    /**
     * @return Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param Transaction $transaction
     */
    public function addTransaction(Transaction $transaction)
    {
        $id = $transaction->getId();
        if (array_key_exists($id, $this->transactions)) {
            throw new InvalidArgumentException(sprintf(
                'Cannot add transaction with id %s, it already exists',
                $id
            ));
        }
        $this->transactions[$id] = $transaction;
    }
}
