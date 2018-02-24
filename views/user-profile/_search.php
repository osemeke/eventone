<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?php echo $form->field($model, 'business_name') ?>

    <?php echo $form->field($model, 'phone_number') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'referrer') ?>

    <?php // echo $form->field($model, 'referrals') ?>

    <?php // echo $form->field($model, 'blogs') ?>

    <?php // echo $form->field($model, 'catalogs') ?>

    <?php // echo $form->field($model, 'reputation') ?>

    <?php // echo $form->field($model, 'maximum_service') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'picture_extension') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'token') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
