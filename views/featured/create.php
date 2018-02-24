<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Featured */

$this->title = 'Create Featured';
$this->params['breadcrumbs'][] = ['label' => 'Featureds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="featured-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
