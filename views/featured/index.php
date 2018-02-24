<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeaturedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Featured';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="featured-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'description',
            'username',
            'business_name',
            // 'phone_number',
            // 'email:email',
            // 'website',
            // 'address',
            // 'city',
            // 'state',
            // 'days',
            // 'amount',
            // 'start_date',
            // 'end_date',
            'active',
            // 'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
