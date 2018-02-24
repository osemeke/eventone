<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            // 'category_id',
            'description',
            'minimum_price',
            // 'maximum_price',
            'hidden:boolean',
            // 'maximum_image',
            'hit_count',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{picture} {view} {update} {delete}',
                'buttons' => [
                    'picture' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url, [
                                'title' => Yii::t('yii', 'Picture'),
                                'data-pjax' => '0',
                            ]);
                        },
                ],
            ],
           
        ],
    ]); ?>

</div>
