<?php
use yii\helpers\Html;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
use kartik\sidenav\SideNav;

/* @var $this yii\web\View */
$this->title = 'Home';
?>
<div class="site-index">

	<div class="row">
		<!-- side nav -->


<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_left_bar') ?></div>



    <?php
// echo SideNav::widget([
//     'items' => [
//         [
//             'url' => ['/site/index'],
//             'label' => 'Home',
//             'icon' => 'home'
//         ],
//         [
//             'url' => ['/site/about'],
//             'label' => 'About',
//             'icon' => 'info-sign',
//             'items' => [
//                  ['url' => '#', 'label' => 'Item 1'],
//                  ['url' => '#', 'label' => 'Item 2'],
//             ],
//         ],
//     ],
// ]);
?>
		<!-- main slide -->
		<div class="col-md-8">
			<div id="owl-main-slide" class="owl-carousel owl-theme">
				<div class="item"><img src="<?= Url::base() ?>/images/carousel/iPhone6.jpg" alt="The Last of us"></div>
				<div class="item"><img src="<?= Url::base() ?>/images/carousel/MacBookAir.jpg" alt="The Last of us"></div>
			</div>



<!-- featured col-lg-3 col-md-3 col-sm-6 col-xs-12-->
<h3>Featured</h3>
<div class="row">
<?php

foreach ($featured as $feature) {

  if ($feature->picture == null) {
    $feature->picture = 'no-image.png';
  }

  $viewlink = $feature->website;
  if ($feature->website == null) {
      $viewlink = '#';
  }

echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
    <div class='feature-thumb thumbnail'>";

echo "
    <div>
      <a href='" . $viewlink . "'>
      ".Html::img('@web/images/services/' . $feature->picture, ['class' => 'img-responsive', 'alt' => '', 'width' => '100%', 'height' => '50%'])."
      </a>
    </div>
    
      <div class='caption sink'>";

      echo "<h4><a href=" . $viewlink . "><b>".$feature->business_name."</b></a></h4>";
      echo "<p class=\"summary\"><i class=\"fa fa-phone\"></i> ".$feature->phone_number."<br />";
      echo "<i class=\"fa fa-map-marker\"></i> ".$feature->city.", ".$feature->state."<br />";
      

echo "</div></div>
</div>";
}
?>
</div>


    </div>

<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_right_bar') ?></div>

	</div>
</div>
