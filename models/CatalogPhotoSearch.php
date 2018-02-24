<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatalogPhoto;

/**
 * CatalogPhotoSearch represents the model behind the search form about `app\models\CatalogPhoto`.
 */
class CatalogPhotoSearch extends CatalogPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'likes', 'verified', 'hidden', 'male', 'female', 'children', 'formal_wear', 'native', 'aso_ebi', 'groom_wear', 'bridal_wear', 'suit', 'wedding_dress', 'bridesmaid_dress', 'bridal_accessory', 'costume', 'jewelry', 'beads', 'hairstyle', 'cake', 'decoration', 'photography'], 'integer'],
            [['description', 'image_link', 'uploaded_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // modified!
        if(Yii::$app->user->identity->role <= 2) {
            $query = CatalogPhoto::find();
        }else{
            $query = CatalogPhoto::find()->where(['user_id' => Yii::$app->user->identity->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'likes' => $this->likes,
            'verified' => $this->verified,
            'hidden' => $this->hidden,
            'male' => $this->male,
            'female' => $this->female,
            'children' => $this->children,
            'formal_wear' => $this->formal_wear,
            'native' => $this->native,
            'aso_ebi' => $this->aso_ebi,
            'groom_wear' => $this->groom_wear,
            'bridal_wear' => $this->bridal_wear,
            'suit' => $this->suit,
            'wedding_dress' => $this->wedding_dress,
            'bridesmaid_dress' => $this->bridesmaid_dress,
            'bridal_accessory' => $this->bridal_accessory,
            'costume' => $this->costume,
            'jewelry' => $this->jewelry,
            'beads' => $this->beads,
            'hairstyle' => $this->hairstyle,
            'cake' => $this->cake,
            'decoration' => $this->decoration,
            'photography' => $this->photography,
            'uploaded_at' => $this->uploaded_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
