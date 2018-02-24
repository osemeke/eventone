<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row"> <div class="col-lg-4">  <!-- first col -->

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        ['prompt' => '---Select Category---']
    ) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    </div> <div class="col-lg-4">  <!-- second col -->

    <?= $form->field($model, 'minimum_price')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'maximum_price')->textInput(['maxlength' => 19]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>




    </div> <div class="col-lg-4">  <!-- third col -->



    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>
