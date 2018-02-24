<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $group;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_left_bar', ['categoryidarray' => $categoryidarray]) ?></div>
<!-- main content--><div class="col-md-8 group-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php
	if ($count == 0) {
		echo "<div class=\"alert alert-info\">There are no listings found for this group!</div>";
	}

	foreach ($model as $service) {

		$imagelink = 'no-image.png';
		$viewlink = 'view?id='.$service->id;
		$i = 0;
		foreach ($service->serviceImages as $picture) {
			if($i > 0) { break; } $i = 1;
			$imagelink = $picture->image;
		}
      
        echo "<div class=\" col-lg-4 col-md-4 col-sm-6 col-xs-12\"><div class=\"thumbnail fixed-item\">";
        echo "<div class=\"crop\">";
		echo "<a href=" . $viewlink . ">";        
	    echo Html::img('@web/images/services/' . $imagelink, ['alt' => '', 'width' => '100%', 'class' => 'portrait']) . "";
	    echo "</div>";
		echo "<a>";        
	    echo "<div class=\"caption\">";
	    echo "<h4><a href=" . $viewlink . "><b>".$service->user->business_name."</b></a></h4>";
	    echo "<p class=\"summary\"><i class=\"fa fa-phone\"></i> ".$service->user->phone_number."<br />";
	    echo "<i class=\"fa fa-map-marker\"></i> ".$service->user->city.", ".$service->user->state."<br />";
	    echo "From &#8358;".number_format($service->minimum_price);
	    echo "<p>";
	    echo "</div>";
        echo "</div></div>";
	}

	echo "<p class=\"pager\">";
	// display pagination
	echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]);
	echo "</p>";

	?>

<!-- endof main content--></div>
<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_right_bar') ?></div>

</div>