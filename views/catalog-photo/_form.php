<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-photo-form">

    <?php $form = ActiveForm::begin([
        // 'action' => ['photo-catalog/picture?id=' . $photo_catalog_id],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row"> <div class="col-lg-3">  <!-- first col -->

 
    <?= $form->field($model, 'file')->widget(kartik\file\FileInput::classname(), [
        'options' => ['accept'=>'image/*'],
        'pluginOptions' => ['allowedFileExtensions' => ['jpg','gif','png']],
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 50]) ?>

   <?php 
        if(Yii::$app->user->identity->role <= 2) 
        {
            echo $form->field($model, 'verified')->checkBox();
            echo $form->field($model, 'hidden')->checkBox();
        }
   ?>


    </div> <div class="col-lg-1">  <!-- second col -->
    </div> <div class="col-lg-2">  <!-- second col -->

    <?= $form->field($model, 'male')->checkBox() ?>

    <?= $form->field($model, 'female')->checkBox() ?>

    <?= $form->field($model, 'children')->checkBox() ?>

    <?= $form->field($model, 'native')->checkBox() ?>

    <?= $form->field($model, 'aso_ebi')->checkBox() ?>

    <?= $form->field($model, 'groom_wear')->checkBox() ?>

    <?= $form->field($model, 'bridal_wear')->checkBox() ?>



    </div> <div class="col-lg-2">  <!-- third col -->

    <?= $form->field($model, 'formal_wear')->checkBox() ?>

    <?= $form->field($model, 'suit')->checkBox() ?>

    <?= $form->field($model, 'wedding_dress')->checkBox() ?>

    <?= $form->field($model, 'bridesmaid_dress')->checkBox() ?>

    <?= $form->field($model, 'bridal_accessory')->checkBox() ?>

    <?= $form->field($model, 'costume')->checkBox() ?>

    <?= $form->field($model, 'jewelry')->checkBox() ?>


    </div> <div class="col-lg-2">  <!-- third col -->

    <?= $form->field($model, 'beads')->checkBox() ?>

    <?= $form->field($model, 'hairstyle')->checkBox() ?>

    <?= $form->field($model, 'cake')->checkBox() ?>

    <?= $form->field($model, 'decoration')->checkBox() ?>

    <?= $form->field($model, 'photography')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Upload Photo' : 'Update Photo', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    </div> <div class="col-lg-2">  <!-- third col -->

        <div class="item-image">
        <?php
            // echo "<div class=\"thumbnail\">";
            echo Html::img('@web/images/catalogs/' . $model->image_link, ['alt' => '', 'class' => 'img-thumbnail', 'width' => '100%x180']) . "";
            // echo "</div>";
        ?>
        </div>

    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>

