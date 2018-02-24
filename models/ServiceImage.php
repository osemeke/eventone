<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_image".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $image
 * @property string $description
 * @property integer $sort_order
 *
 * @property Service $service
 */
class ServiceImage extends \yii\db\ActiveRecord
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
        return 'service_image';
    }

    /**
     * @inheritdoc 
     */
    public function rules()
    {
        return [
            [['service_id'], 'required'],
            [['service_id', 'sort_order'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg, gif, png'],//, 'skipOnEmpty' => false
            [['description'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'image' => 'Image',
            'description' => 'Description',
            'sort_order' => 'Sort Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
