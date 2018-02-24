<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog_photo".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property integer $likes
 * @property string $image_link
 * @property integer $verified
 * @property integer $hidden
 * @property integer $male
 * @property integer $female
 * @property integer $children
 * @property integer $formal_wear
 * @property integer $native
 * @property integer $aso_ebi
 * @property integer $groom_wear
 * @property integer $bridal_wear
 * @property integer $suit
 * @property integer $wedding_dress
 * @property integer $bridesmaid_dress
 * @property integer $bridal_accessory
 * @property integer $costume
 * @property integer $jewelry
 * @property integer $beads
 * @property integer $hairstyle
 * @property integer $cake
 * @property integer $decoration
 * @property integer $photography
 * @property string $uploaded_at
 */
class CatalogPhoto extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'description'], 'required', 'message' => ''],
            [['user_id', 'likes', 'verified', 'hidden', 'male', 'female', 'children', 'formal_wear', 'native', 'aso_ebi', 'groom_wear', 'bridal_wear', 'suit', 'wedding_dress', 'bridesmaid_dress', 'bridal_accessory', 'costume', 'jewelry', 'beads', 'hairstyle', 'cake', 'decoration', 'photography'], 'integer'],
            [['uploaded_at'], 'safe'],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions'=>'jpg, gif, png'],//, 'skipOnEmpty' => false
            [['description'], 'string', 'max' => 50],
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
            'description' => 'Description',
            'likes' => 'Likes',
            'file' => 'Select Image',
            // 'image_link' => 'Image Link',
            'verified' => 'Verified',
            'hidden' => 'Hidden',
            'male' => 'Male',
            'female' => 'Female',
            'children' => 'Children',
            'formal_wear' => 'Formal Wear',
            'native' => 'Native',
            'aso_ebi' => 'Aso Ebi',
            'groom_wear' => 'Groom Wear',
            'bridal_wear' => 'Bridal Wear',
            'suit' => 'Suit',
            'wedding_dress' => 'Wedding Dress',
            'bridesmaid_dress' => 'Bridesmaid Dress',
            'bridal_accessory' => 'Bridal Accessory',
            'costume' => 'Costume',
            'jewelry' => 'Jewelry',
            'beads' => 'Beads',
            'hairstyle' => 'Hairstyle',
            'cake' => 'Cake',
            'decoration' => 'Decoration',
            'photography' => 'Photography',
            'uploaded_at' => 'Uploaded At',
        ];
    }
}
