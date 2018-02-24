<?php
use yii\helpers\Html;
use app\models\Advert;
use app\models\TargetedAdvert;

$adverts = Advert::find()->Where(['active' => 1, 'position' => 0])->all();
$tardetedad = isset($categoryidarray) ? randomTargetedAdvert($categoryidarray) : randomTargetedAdvert();

foreach ($adverts as $ad) {
	echo "<div class='item'> <div class='image'><a href='".$ad->website."'>";
    echo Html::img('@web/images/adverts/' . $ad->banner .'', ['alt' => $ad->title,'class'=>'img-responsive']);
	echo "</a></div></div>";
}


	echo "<div class='item'> <div class='image'><a href='".$tardetedad['website']."'>";
    echo Html::img('@web/images/targetedads/' . $tardetedad['banner'], ['alt' => '','class'=>'img-responsive']);
	echo "</a></div></div>";


//functions


function randomTargetedAdvert($ids = null)
{
    $date = date("Y-m-d");

    if($ids == null){
        $catid = isset($_GET['id']) ? $_GET['id'] : 0;
    } else {
        $catid = $ids;
    }

    // $ads = TargetedAdvert::find()
    $ads = TargetedAdvert::find()->where(['category_id' => $catid])
        ->andWhere('active = :active AND end_date >= :today_date AND start_date <= :today_date', [':today_date' => $date, ':active' => 1])
        ->orderBy('sort_order')
        ->one()
        ;

    $banner = 'ad-space.png';
    $website = '#';
    
    if($ads !== null){
        // echo $ads->sort_order;
        // echo "<br />";
        $ads->sort_order += 1;
        // echo $ads->image_link;
        // echo "<br />";
        // echo $ads->sort_order;
        // echo "<br />";
        $ads->save();
        $banner = $ads->image_link;
        $website = $ads->website;
    }

    return [
        'banner' => $banner,
        'website' => $website,
    ];
}