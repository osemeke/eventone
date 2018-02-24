<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\State;
use app\models\City;
use app\assets\CkeditorAsset;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
CkeditorAsset::register($this);
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row"> <div class="col-lg-3">  <!-- first col -->

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'disabled' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'gender')->dropDownList(
        ['Male' => 'Male','Female' => 'Female'], //'id','label'
        ['prompt' => '---Select Gender---']
    ) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 11]) ?>

    </div> <div class="col-lg-3">  <!-- second col -->

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'state_id')->dropDownList(
        ArrayHelper::map(State::find()->all(), 'id', 'name'), //'id','label'
        [
            'prompt' => '---Select State---',
            'onChange' => '
                $.post( "cities?id=' . '" + $(this).val(), function(data){
                    $("select#userprofile-city_id").html(data);
                });

            ',
        ]
    ) ?>

    <?= $form->field($model, 'city_id')->dropDownList(
        ArrayHelper::map(City::find()->where(['state_id' => $model->state_id])->all(), 'id', 'name'), //'id','label'
        [
            'prompt' => '---Select City---'
        ]
    ) ?>

    <!-- $form->field($model, 'state')->textInput(['maxlength' => 50]) -->

     <!-- $form->field($model, 'city')->textInput(['maxlength' => 50]) ?> -->

    <?= $form->field($model, 'country')->textInput(['maxlength' => 50, 'disabled' => true]) ?>

    </div> <div class="col-lg-6">  <!-- third col -->

    <?= $form->field($model, 'business_name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'description')->textArea(['rows' => 10, 'maxlength' => 255, 'class' => 'ckeditor']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>
