<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Targeted Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="targeted-advert-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Targeted Advert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            'title',
            // 'banner',
            // 'website',
            // 'days',
            // 'start_date',
            'end_date',
            'active',
            // 'category_id',
            // 'sort_order',
            'hit_count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
