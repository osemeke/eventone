<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use app\models\ServiceImage;
use yii\web\UploadedFile;
/* @var $this yii\web\View */
/* @var $model app\models\ServiceImage */
/* @var $form yii\widgets\ActiveForm */

$model = new ServiceImage();

?>

<div class="service-image-form">

    <?php $form = ActiveForm::begin([
        'action' => ['service/picture?id=' . $service_id],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
 
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept'=>'image/*'],
        // 'maxFileSize' => 20,
        'pluginOptions' => ['allowedFileExtensions' => ['jpg','gif','png']],
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
