<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $title
 * @property string $sub_title
 * @property string $paragraph_1
 * @property string $paragraph_2
 * @property string $paragraph_3
 * @property string $paragraph_4
 * @property integer $sort_order
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort_order'], 'integer'],
            [['title', 'sub_title', 'paragraph_1', 'paragraph_2', 'paragraph_3', 'paragraph_4'], 'string', 'max' => 255]
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
            'sub_title' => 'Sub Title',
            'paragraph_1' => 'Paragraph 1',
            'paragraph_2' => 'Paragraph 2',
            'paragraph_3' => 'Paragraph 3',
            'paragraph_4' => 'Paragraph 4',
            'sort_order' => 'Sort Order',
        ];
    }
}
