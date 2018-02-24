<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row"> <div class="col-lg-4">  <!-- first col -->

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'disabled' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList(
        [
            '1' => 'Super User',
            '2' => 'Administrator',
            '9' => 'User'
        ], //'id','label'
        ['prompt' => '---Select Role---']
    ) ?>

    <?= $form->field($model, 'active')->dropDownList(
        [
            '0' => 'Blocked',
            '1' => 'Active'
        ], //'id','label'
        ['prompt' => '---Select Active---']
    ) ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            '0' => 'Deleted',
            '1' => 'Active'
        ], //'id','label'
        ['prompt' => '---Select Status---']
    ) ?>

    <?= $form->field($model, 'token')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'reputation')->textInput() ?>

    <?= $form->field($model, 'maximum_service')->textInput() ?>

    </div> <div class="col-lg-4">  <!-- second col -->

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'gender')->dropDownList(
        ['Male' => 'Male','Female' => 'Female'], //'id','label'
        ['prompt' => '---Select Gender---']
    ) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 100]) ?>

    </div> <div class="col-lg-4">  <!-- second col -->

    <?= $form->field($model, 'business_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'country')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>
