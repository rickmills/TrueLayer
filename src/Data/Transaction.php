<?php

namespace TrueLayer\Data;

use TrueLayer\Categories;
use TrueLayer\Data as Model;

class Transaction extends Model
{
    /**
     * Some constants
     *
     * @var string
     */
    const TYPE_CREDIT = 'CREDIT';
    const TYPE_DEBIT = 'DEBIT';

    /**
     * Transaction id
     *
     * @var string
     */
    public $id;

    /**
     * Transaction description
     *
     * @var string
     */
    public $description;

    /**
     * Transaction type
     *
     * @var string
     */
    public $type;

    /**
     * Transaction category
     *
     * @var string
     */
    public $category;

    /**
     * Transaction classification
     *
     * @var array
     */
    public $classification = [];

    /**
     * Merchant name
     *
     * @var string
     */
    public $merchant_name;

    /**
     * Transaction amount
     *
     * @var double
     */
    public $amount;

    /**
     * Transaction currency
     *
     * @var string
     */
    public $currency;

    /**
     * Transaction meta
     *
     * @var array
     */
    public $meta;

    /**
     * Transaction timestamp
     *
     * @var \DateTime
     */
    public $timestamp;

    /**
     * Skip dotting meta
     *
     * @var mixed
     */
    public $should_dot = ['meta'];

    /**
     * Provide a map from array
     * to DTO
     *
     * @var array
     * @return array
     */
    public function map()
    {
        return [
            'id' => ['key' => 'transaction_id'],
            'description' => ['key' => 'description'],
            'type' => ['key' => 'transaction_type'],
            'category' => ['key' => 'transaction_category'],
            'classification' => ['key' => 'transaction_classification'],
            'merchant_name' => ['key' => 'merchant_name'],
            'amount' => ['key' => 'amount'],
            'currency' => ['key' => 'currency'],
            'meta' => ['key' => 'meta'],
            'timestamp' => ['key' => 'timestamp',
                'callback' => function ($value) {
                    return new \DateTime($value);
                }
            ]
        ];
    }

    /**
     * Is bill payment
     *
     * @return bool
     */
    public function isBillPayment()
    {
        return $this->category == Categories::BILL_PAYMENT;
    }

    /**
     * Is direct debit
     *
     * @return bool
     */
    public function isDirectDebit()
    {
        return $this->category == Categories::DIRECT_DEBIT;
    }

    /**
     * Is standing order
     *
     * @return bool
     */
    public function isStandingOrder()
    {
        return $this->category == Categories::STANDING_ORDER;
    }

    /**
     * Is fee
     *
     * @return bool
     */
    public function isBankingFee()
    {
        return $this->category == Categories::FEE_CHARGE;
    }

    /**
     * is debit
     *
     * @return bool
     */
    public function isDebit()
    {
        return $this->type == self::TYPE_DEBIT;
    }

    /**
     * is credit
     *
     * @return bool
     */
    public function isCredit()
    {
        return $this->type == self::TYPE_CREDIT;
    }
}
