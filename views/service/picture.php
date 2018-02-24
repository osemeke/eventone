<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Service */

$this->title = 'Pictures: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Pictures';
?>
<div class="service-picture">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-4">

    <?= $this->render('_picture', [
        'service_id' => $service_id,
    ]) ?>

        </div>
        <div class="col-lg-8">  <!-- second col -->

        <div class="item-image">
        <?php
        foreach ($model->serviceImages as $picture) {
            echo "<div class=\"col-lg-4\"><div class=\"thumbnail\">";
        	echo Html::img('@web/images/services/' . $picture->image, ['alt' => '', 'class' => 'img-thumbnail', 'width' => '100%x180']) . "";

            echo "<div class=\"caption\">";
            echo "<p>".$picture->description."</p>";

            echo "<p>";
            echo Html::a('Delete', ['remove', 'id' => $picture->id, 'sid' => $picture->service_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
            echo "</p>";
            echo "</div></div></div>";


        }
        ?>
        </div>

<!-- 
  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img data-src="holder.js/100%x180" alt="...">
    </a>
  </div>
       

<div class="col-sm-6 col-md-4">
<div class="thumbnail">
  <img data-src="holder.js/300x200" alt="...">
  <div class="caption">
    <h3>Thumbnail label</h3>
    <p>...</p>
    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
  </div>
</div>
</div>
 -->

        </div>
    </div>

</div>
