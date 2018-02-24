<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row"> <div class="col-lg-4">  <!-- first col -->

    <?= $form->field($model, 'business_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 100]) ?>



    </div> <div class="col-lg-4">  <!-- second col -->   

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'position')->dropDownList(
        [
            '0' => 'Left Column',
            '1' => 'Right Column',
        ], //'id','label'
        ['prompt' => '---Select Position---']
    ) ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter end date ...'],
                'name' => 'end_date', 
                'value' => date('Y-m-d'),// strtotime('+30 days')),
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    //'todayHighlight' => false,
                    'autoclose'=>true
            ]
        ]);
    ?>

    <?= $form->field($model, 'active')->checkBox() ?>


    </div> <div class="col-lg-4">  <!-- third col -->

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>


    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>



    </div>  <!-- endof cols -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
