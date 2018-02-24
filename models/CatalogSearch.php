<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatalogPhoto;

/**
 * CatalogPhotoSearch represents the model behind the search form about `app\models\CatalogPhoto`.
 */
class CatalogSearch extends CatalogPhoto
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
        // $query = CatalogPhoto::find();
        $this->load($params);

        $condition = '';
        $or = '';
        // if ($this->male == 1) { $condition .= $or . 'male =' . $this->male; $or = ' OR '; }
        // if ($this->female == 1) { $condition .= $or . 'female =' . $this->female; $or = ' OR '; }
        // if ($this->children == 1) { $condition .= $or . 'children =' . $this->children; $or = ' OR '; }
        // if ($this->formal_wear == 1) { $condition .= $or . 'formal_wear =' . $this->formal_wear; $or = ' OR '; }
        // if ($this->native == 1) { $condition .= $or . 'native =' . $this->native; $or = ' OR '; }
        // if ($this->aso_ebi == 1) { $condition .= $or . 'aso_ebi =' . $this->aso_ebi; $or = ' OR '; }
        // if ($this->groom_wear == 1) { $condition .= $or . 'groom_wear =' . $this->groom_wear; $or = ' OR '; }
        // if ($this->bridal_wear == 1) { $condition .= $or . 'bridal_wear =' . $this->bridal_wear; $or = ' OR '; }
        // if ($this->suit == 1) { $condition .= $or . 'suit =' . $this->suit; $or = ' OR '; }
        // if ($this->wedding_dress == 1) { $condition .= $or . 'wedding_dress =' . $this->wedding_dress; $or = ' OR '; }
        // if ($this->bridesmaid_dress == 1) { $condition .= $or . 'bridesmaid_dress =' . $this->bridesmaid_dress; $or = ' OR '; }
        // if ($this->bridal_accessory == 1) { $condition .= $or . 'bridal_accessory =' . $this->bridal_accessory; $or = ' OR '; }
        // if ($this->costume == 1) { $condition .= $or . 'costume =' . $this->costume; $or = ' OR '; }
        // if ($this->jewelry == 1) { $condition .= $or . 'jewelry =' . $this->jewelry; $or = ' OR '; }
        // if ($this->beads == 1) { $condition .= $or . 'beads =' . $this->beads; $or = ' OR '; }
        // if ($this->hairstyle == 1) { $condition .= $or . 'hairstyle =' . $this->hairstyle; $or = ' OR '; }
        // if ($this->cake == 1) { $condition .= $or . 'cake =' . $this->cake; $or = ' OR '; }
        // if ($this->decoration == 1) { $condition .= $or . 'decoration =' . $this->decoration; $or = ' OR '; }
        // if ($this->photography == 1) { $condition .= $or . 'photography =' . $this->photography; $or = ' OR '; }
        if ($this->male == 1) { $condition .= "{$or}male ={$this->male}"; $or = ' OR '; }
        if ($this->female == 1) { $condition .= "{$or}female ={$this->female}"; $or = ' OR '; }
        if ($this->children == 1) { $condition .= "{$or}children ={$this->children}"; $or = ' OR '; }
        if ($this->formal_wear == 1) { $condition .= "{$or}formal_wear ={$this->formal_wear}"; $or = ' OR '; }
        if ($this->native == 1) { $condition .= "{$or}native ={$this->native}"; $or = ' OR '; }
        if ($this->aso_ebi == 1) { $condition .= "{$or}aso_ebi ={$this->aso_ebi}"; $or = ' OR '; }
        if ($this->groom_wear == 1) { $condition .= "{$or}groom_wear ={$this->groom_wear}"; $or = ' OR '; }
        if ($this->bridal_wear == 1) { $condition .= "{$or}bridal_wear ={$this->bridal_wear}"; $or = ' OR '; }
        if ($this->suit == 1) { $condition .= "{$or}suit ={$this->suit}"; $or = ' OR '; }
        if ($this->wedding_dress == 1) { $condition .= "{$or}wedding_dress ={$this->wedding_dress}"; $or = ' OR '; }
        if ($this->bridesmaid_dress == 1) { $condition .= "{$or}bridesmaid_dress ={$this->bridesmaid_dress}"; $or = ' OR '; }
        if ($this->bridal_accessory == 1) { $condition .= "{$or}bridal_accessory ={$this->bridal_accessory}"; $or = ' OR '; }
        if ($this->costume == 1) { $condition .= "{$or}costume ={$this->costume}"; $or = ' OR '; }
        if ($this->jewelry == 1) { $condition .= "{$or}jewelry ={$this->jewelry}"; $or = ' OR '; }
        if ($this->beads == 1) { $condition .= "{$or}beads ={$this->beads}"; $or = ' OR '; }
        if ($this->hairstyle == 1) { $condition .= "{$or}hairstyle ={$this->hairstyle}"; $or = ' OR '; }
        if ($this->cake == 1) { $condition .= "{$or}cake ={$this->cake}"; $or = ' OR '; }
        if ($this->decoration == 1) { $condition .= "{$or}decoration ={$this->decoration}"; $or = ' OR '; }
        if ($this->photography == 1) { $condition .= "{$or}photography ={$this->photography}"; $or = ' OR '; }
        
        $query = CatalogPhoto::find()->where($condition)->andWhere('hidden=0');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->orFilterWhere([
        //     'male' => $this->male,
        //     'female' => $this->female,
        //     'children' => $this->children,
        //     'formal_wear' => $this->formal_wear,
        //     'native' => $this->native,
        //     'aso_ebi' => $this->aso_ebi,
        //     'groom_wear' => $this->groom_wear,
        //     'bridal_wear' => $this->bridal_wear,
        //     'suit' => $this->suit,
        //     'wedding_dress' => $this->wedding_dress,
        //     'bridesmaid_dress' => $this->bridesmaid_dress,
        //     'bridal_accessory' => $this->bridal_accessory,
        //     'costume' => $this->costume,
        //     'jewelry' => $this->jewelry,
        //     'beads' => $this->beads,
        //     'hairstyle' => $this->hairstyle,
        //     'cake' => $this->cake,
        //     'decoration' => $this->decoration,
        //     'photography' => $this->photography,
        // ]);

        return $dataProvider;
    }
}