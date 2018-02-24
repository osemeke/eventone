<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\About */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'paragraph_1')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'paragraph_2')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'paragraph_3')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'paragraph_4')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
