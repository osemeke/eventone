<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TargetedAdvert */

$this->title = 'Create Targeted Advert';
$this->params['breadcrumbs'][] = ['label' => 'Targeted Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="targeted-advert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
