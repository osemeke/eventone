<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Featured */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="featured-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row"> <div class="col-lg-4">  <!-- first col -->

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

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'active')->checkBox() ?>
      
    <?= $form->field($model, 'picture')->dropDownList(
        ArrayHelper::map($serviceimages->all(), 'image', 'image'), //'id','label'
        ['prompt' => '---Select Picture---']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    </div> <div class="col-lg-4">  <!-- second col -->


    <?= $form->field($model, 'user_id')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['disabled' => true]) ?>



    </div> <div class="col-lg-4">  <!-- third col -->

    <?= $form->field($model, 'business_name')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['disabled' => true]) ?>


    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>



    <div class="row"> <ul class="thumbnails">
<?php
// $serviceids = \app\models\Service::find()->select('id')->where(['user_id' => 1])->asArray();//->all();
// print_r($serviceids);
// $serviceimages = \app\models\ServiceImage::find()->where(['service_id' => $serviceids]);//->all();

// echo $serviceimages->count();
foreach ($serviceimages->all() as $images) {
    echo "<li class='image-additional'>
    <a class='thumbnail' href='#'>".   Html::img('@web/images/services/' .$images->image, ['alt' => $images->image, 'title' => $images->image, 'width' => '100%', 'class' => 'portrait']) ."
    </a></li>";
}

?>
    </ul>

</div>
