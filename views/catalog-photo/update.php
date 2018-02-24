<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhoto */

$this->title = 'Update Catalog Photo: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Catalog Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="catalog-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete Photo', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
