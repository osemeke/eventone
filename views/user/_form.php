<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'role')->dropDownList(
        [
            '1' => 'Super User',
            '2' => 'Administrator',
            '9' => 'User'
        ], //'id','label'
        ['prompt' => '---Select Role---']
    ) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
