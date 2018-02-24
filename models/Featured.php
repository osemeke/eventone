<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "featured".
 *
 * @property integer $id
 * @property string $description
 * @property integer $user_id
 * @property string $username
 * @property string $business_name
 * @property string $phone_number
 * @property string $email
 * @property string $website
 * @property string $address
 * @property string $city
 * @property string $state
 * @property integer $days
 * @property string $amount
 * @property string $start_date
 * @property string $end_date
 * @property integer $active
 * @property integer $sort_order
 */
class Featured extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'featured';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'end_date'], 'required'],
            [['user_id', 'active', 'sort_order'], 'integer'],
            [['email', 'website', 'picture'], 'string', 'max' => 100],
            [['username', 'business_name', 'city', 'state'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 11],
            [['address'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'user_id' => 'User ID',
            'username' => 'Username',
            'business_name' => 'Business Name',
            'phone_number' => 'Phone Number',
            'picture' => 'Picture',
            'email' => 'Email',
            'website' => 'Website',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'end_date' => 'End Date',
            'active' => 'Active',
            'sort_order' => 'Sort Order',
        ];
    }
}
