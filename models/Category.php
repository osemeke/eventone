<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_group_id
 * @property integer $sort
 * @property integer $hit_count
 *
 * @property CategoryGroup $categoryGroup
 * @property Service[] $services
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_group_id'], 'required'],
            [['category_group_id', 'sort', 'hit_count'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_group_id' => 'Category Group ID',
            'sort' => 'Sort',
            'hit_count' => 'Hit Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryGroup()
    {
        return $this->hasOne(CategoryGroup::className(), ['id' => 'category_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['category_id' => 'id']);
    }
}
