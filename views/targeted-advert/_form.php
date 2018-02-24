<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TargetedAdvert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="targeted-advert-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row"> <div class="col-lg-3">  <!-- first col -->

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'days')->textInput() ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 100]) ?>

    </div> <div class="col-lg-3">  <!-- second col -->
 
    <?= $form->field($model, 'file')->widget(kartik\file\FileInput::classname(), [
        'options' => ['accept'=>'image/*'],
        'pluginOptions' => ['allowedFileExtensions' => ['jpg','gif','png']],
    ]) ?>

    </div> <div class="col-lg-3">  <!-- third col -->

    <?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter start date ...'],
                'name' => 'start_date', 
                'value' => date('Y-m-d'),//, strtotime('-30 days')),
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    //'todayHighlight' => false,
                    'autoclose'=>true
            ]
        ]);
    ?>
    
    <?= $form->field($model, 'category_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name'),
        ['prompt' => '---Select Category---']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create Advert' : 'Update Advert', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    </div> <div class="col-lg-3">  <!-- third col -->

        <div class="item-image">
        <?php
            // echo "<div class=\"thumbnail\">";
            echo Html::img('@web/images/targetedads/' . $model->image_link, ['alt' => '', 'class' => 'img-thumbnail', 'width' => '100%x180']) . "";
            // echo "</div>";
        ?>
        </div>

    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>
