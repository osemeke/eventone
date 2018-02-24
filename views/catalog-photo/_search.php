<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhotoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-photo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
    ]); ?>


    <div class="row"> <div class="col-lg-2">  <!-- first col -->

    <?php echo $form->field($model, 'male')->checkBox() ?>

    <?php echo $form->field($model, 'female')->checkBox() ?>

    <?php echo $form->field($model, 'children')->checkBox() ?>

    <?php echo $form->field($model, 'formal_wear')->checkBox() ?>

    </div> <div class="col-lg-2">  <!-- third col -->

    <?php echo $form->field($model, 'native')->checkBox() ?>

    <?php echo $form->field($model, 'aso_ebi')->checkBox() ?>

    <?php echo $form->field($model, 'groom_wear')->checkBox() ?>

    <?php echo $form->field($model, 'bridal_wear')->checkBox() ?>

    </div> <div class="col-lg-2">  <!-- second col -->

    <?php echo $form->field($model, 'suit')->checkBox() ?>

    <?php echo $form->field($model, 'wedding_dress')->checkBox() ?>

    <?php echo $form->field($model, 'bridesmaid_dress')->checkBox() ?>

    <?php echo $form->field($model, 'bridal_accessory')->checkBox() ?>

    </div> <div class="col-lg-2">  <!-- third col -->

    <?php echo $form->field($model, 'costume')->checkBox() ?>

    <?php echo $form->field($model, 'jewelry')->checkBox() ?>

    <?php echo $form->field($model, 'beads')->checkBox() ?>

    <?php echo $form->field($model, 'hairstyle')->checkBox() ?>

     </div> <div class="col-lg-2">  <!-- third col -->

    <?php echo $form->field($model, 'cake')->checkBox() ?>

    <?php echo $form->field($model, 'decoration')->checkBox() ?>

    <?php echo $form->field($model, 'photography')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Recent', ['search'], ['class' => 'btn btn-default']) ?>
    </div>

    </div> <div class="col-lg-2">  <!-- targeted ad col -->

        <div class="item-image">
        <?php
            // echo "<div class=\"thumbnail\">";
            echo "<a href='" . $website_link . "'>";
            echo Html::img('@web/images/targetedads/' . $image_link, ['alt' => '', 'class' => 'img-thumbnail', 'width' => '100%x180']) . "";
            // echo "</div>";
            echo "</a>";
            // echo $image_link;
        ?>
        </div>

    </div>  <!-- endof cols -->

    <?php ActiveForm::end(); ?>

</div>
