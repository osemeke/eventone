<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $description
 * @property string $minimum_price
 * @property string $maximum_price
 * @property integer $hidden
 * @property integer $maximum_image
 * @property integer $hit_count
 *
 * @property Category $category
 * @property User $user
 * @property ServiceImage[] $serviceImages
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'description','minimum_price', 'maximum_price'], 'required', 'message' => ''],
            [['user_id', 'category_id', 'hidden', 'maximum_image', 'hit_count'], 'integer'],
            [['minimum_price', 'maximum_price'], 'number'],
            [['description'], 'string', 'max' => 255]
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
            'category_id' => 'Category',
            'description' => 'Description',
            'minimum_price' => 'Minimum Price',
            'maximum_price' => 'Maximum Price',
            'hidden' => 'Hidden',
            'maximum_image' => 'Maximum Image',
            'hit_count' => 'Hit Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceImages()
    {
        return $this->hasMany(ServiceImage::className(), ['service_id' => 'id']);
    }
}
