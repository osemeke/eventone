<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $account
 * @property string $date
 * @property string $description
 * @property string $amount
 * @property string $debit
 * @property string $credit
 * @property string $balance
 * @property integer $bank
 * @property string $reference
 * @property integer $transaction_type
 */
class Wallet extends \yii\db\ActiveRecord
{
    public $username;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'account', 'transaction_type', 'debit', 'credit'], 'required', 'message' => ''],
            [['user_id', 'account', 'bank', 'transaction_type'], 'integer'],
            [['date'], 'safe'],
            [['amount', 'debit', 'credit', 'balance'], 'number'],
            [['description', 'username'], 'string', 'max' => 50],
            [['reference'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'account' => 'Account',
            'date' => 'Date',
            'description' => 'Description',
            'amount' => 'Amount',
            'debit' => 'Debit',
            'credit' => 'Credit',
            'balance' => 'Balance',
            'bank' => 'Bank',
            'reference' => 'Reference',
            'transaction_type' => 'Transaction Type',
        ];
    }
}
