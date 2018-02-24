<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $gender
 * @property string $business_name
 * @property string $description
 * @property string $phone_number
 * @property string $email
 * @property string $website
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $referrer
 * @property integer $referrals
 * @property integer $blogs
 * @property integer $catalogs
 * @property integer $reputation
 * @property integer $maximum_service
 * @property string $picture
 * @property string $picture_extension
 * @property integer $active
 * @property string $token
 *
 * @property Service[] $services
 * @property Wallet[] $wallets
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at', 'state_id', 'city_id'], 'required'],
            [['role', 'status', 'created_at', 'updated_at', 'referrer', 'referrals', 'blogs', 'catalogs', 'reputation', 'maximum_service', 'active'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name', 'middle_name', 'business_name', 'city', 'state', 'country'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 6],
            [['description'], 'string', 'max' => 900],
            [['phone_number'], 'string', 'max' => 11],
            [['email', 'website', 'picture'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['picture_extension'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'gender' => 'Gender',
            'business_name' => 'Business Name',
            'description' => 'Description',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'website' => 'Website',
            'address' => 'Address',
            'city' => 'City',
            'city_id' => 'City',
            'state_id' => 'State',
            'state' => 'State',
            'country' => 'Country',
            'referrer' => 'Referrer',
            'referrals' => 'Referrals',
            'blogs' => 'Blogs',
            'catalogs' => 'Catalogs',
            'reputation' => 'Reputation',
            'maximum_service' => 'Maximum Service',
            'picture' => 'Picture',
            'picture_extension' => 'Picture Extension',
            'active' => 'Active',
            'token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallets()
    {
        return $this->hasMany(Wallet::className(), ['user_id' => 'id']);
    }
}
