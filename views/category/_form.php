<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\CategoryGroup;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'category_group_id')->dropDownList(
        ArrayHelper::map(CategoryGroup::find()->all(), 'id', 'name'), //'id','label'
        ['prompt' => '---Select Category Group---']
    ) ?>
    
    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'hit_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
