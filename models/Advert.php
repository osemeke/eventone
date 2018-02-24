<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "advert".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $banner
 * @property string $business_name
 * @property string $phone_number
 * @property string $email
 * @property string $website
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $start_date
 * @property string $end_date
 * @property integer $active
 * @property integer $sort_order
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'business_name', 'position', 'end_date'], 'required'],
            [['active', 'sort_order', 'position'], 'integer'],
            [['title', 'email', 'website'], 'string', 'max' => 100],
            // [['banner'], 'string', 'max' => 255],
            [['business_name'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 11],
            [['file'], 'file'],
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
            'title' => 'Title',
            'file' => 'Banner',
            'business_name' => 'Business Name',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'website' => 'Website',
            'address' => 'Address',
            'end_date' => 'End Date',
            'position' => 'Position',
            'active' => 'Active',
            'sort_order' => 'Sort Order',
        ];
    }
}
