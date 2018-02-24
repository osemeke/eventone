<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->user->business_name;//.': '.$model->category->name;
$this->params['breadcrumbs'][] = ['label' => $model->category->categoryGroup->name, 'url' => ['group?id=' . $model->category->category_group_id]];
$this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['category?id=' . $model->category_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_left_bar') ?></div>
<!-- main content--><div class="col-md-8 group-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php


	?>

<!-- yhumbnails -->
        <div class="item-image">
        <?php
        foreach ($model->serviceImages as $picture) {
            echo "<div class=\"col-lg-4\"><div class=\"thumbnail fixed-item\">";
        echo "<div class=\"crop\">";
        	echo Html::img('@web/images/services/' . $picture->image, ['alt' => '', 'width' => '100%x180']) . "";

            	echo "<div class=\"caption\">";
            	echo "<p>" . $picture->description . "</p>";
            	echo "</div>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        ?>
        </div>

<p class="pager">
<!-- tabs -->
<ul class="nav nav-tabs">
<li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
<li><a href="#tab-specification" data-toggle="tab">Contact Information</a></li>
<li><a href="#tab-review" data-toggle="tab"><?= $model->category->name ?></a></li>
</ul>

<div class="tab-content">

<div class="tab-pane active" id="tab-description">
	<div>
		<?= $model->user->description ?>
	</div>
</div>

<!-- specification -->
<div class="tab-pane" id="tab-specification">
	<div>
		<p><b>Phone Number</b>: <?= $model->user->phone_number ?><p>
		<p><b>Email</b>: <?= $model->user->email ?><p>
		<p><b>Website</b>: <?= $model->user->website ?><p>
		<p><b>Address</b>: <?= $model->user->address ?><p>
		<p><b>City</b>: <?= $model->user->city ?><p>
		<p><b>State</b>: <?= $model->user->state ?><p>
	
	</div>

</div>

<!-- review -->
<div class="tab-pane" id="tab-review">
<div>
		<p><b>Description</b>: <?= $model->description ?><p>
		<p><b>Price Range</b>: <?= "&#8358;" . number_format($model->minimum_price) . " - &#8358;" . number_format($model->maximum_price) ?><p>
</div>
</div>
<!-- endof review -->

</div>
</p>


<!-- endof main content--></div>
<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_right_bar') ?></div>

</div>
