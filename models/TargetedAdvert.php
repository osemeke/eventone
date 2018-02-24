<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "targeted_advert".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $ima
 * @property string $website
 * @property integer $days
 * @property string $start_date
 * @property string $end_date
 * @property integer $active
 * @property integer $category_id
 * @property integer $sort_order
 * @property integer $hit_count
 */
class TargetedAdvert extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'targeted_advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'days', 'start_date', 'category_id'], 'required', 'message' => ''],
            [['user_id', 'days', 'active', 'category_id', 'sort_order', 'hit_count'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg, gif, png'],//, 'skipOnEmpty' => false
            [['title', 'website'], 'string', 'max' => 100],
            [['image_link'], 'string', 'max' => 255]
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
            'title' => 'Title',
            // 'banner' => 'Banner',
            'website' => 'Website',
            'days' => 'Days',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'active' => 'Active',
            'category_id' => 'Category',
            'sort_order' => 'Sort Order',
            'hit_count' => 'Hit Count',
        ];
    }
}
