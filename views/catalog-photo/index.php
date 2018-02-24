<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalog Photos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Catalog Photo', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Browse Photo Catalog', ['search'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            'description',
            'likes',
            // 'image_link',
            'verified',
            'hidden',
            // 'photography',
            // 'uploaded_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
