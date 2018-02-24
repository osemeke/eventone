<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatalogPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', [
    	'model' => $searchModel,
      'image_link' => $image_link,
      'website_link' => $website_link
    	]); 


foreach ($model as $photo) {
echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
    <div class='feature-thumb thumbnail'>";

echo "
      <a href='view?id=" . $photo->id . "'>
      ".Html::img('@web/images/catalogs/' . $photo->image_link, ['class' => 'img-responsive', 'alt' => ''])."
      </a></div></div>";
}



    ?>


</div>
