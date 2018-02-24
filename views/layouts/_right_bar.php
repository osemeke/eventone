<?php
use yii\helpers\Html;
use app\models\Advert;


$adverts = Advert::find()->Where(['active' => 1, 'position' => 1])->all();

foreach ($adverts as $ad) {
	echo "<div class='item'> <div class='image'><a href='".$ad->website."'>";
    echo Html::img('@web/images/adverts/' . $ad->banner .'', ['alt' => $ad->title,'class'=>'img-responsive']);
	echo "</a></div></div>";
}