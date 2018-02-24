<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Featured */

$this->title = 'Update Featured: ' . ' ' . $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Featureds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="featured-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'serviceimages' => $serviceimages,
    ]) ?>

</div>

