<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wallet;

/**
 * WalletSearch represents the model behind the search form about `app\models\Wallet`.
 */
class WalletSearch extends Wallet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'account', 'bank', 'transaction_type'], 'integer'],
            [['date', 'description', 'reference'], 'safe'],
            [['amount', 'debit', 'credit', 'balance'], 'number'],
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
        $query = Wallet::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'account' => $this->account,
            'date' => $this->date,
            'amount' => $this->amount,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'balance' => $this->balance,
            'bank' => $this->bank,
            'transaction_type' => $this->transaction_type,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
