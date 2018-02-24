<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CatalogPhoto */

$this->title = ucfirst($model->description);
$this->params['breadcrumbs'][] = ['label' => 'Photo Catalog', 'url' => ['search']];
$this->params['breadcrumbs'][] = $this->title;

$user = \app\models\UserProfile::findOne($model->user_id);
?>

<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_left_bar') ?></div>
<!-- main content--><div class="col-md-8 group-index">


    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    if ($model->hidden == 0) {
        // echo "<div class=\"thumbnail\">";
        echo Html::img('@web/images/catalogs/' . $model->image_link, [
            'class' => 'img-thumbnail', 
            'width' => '60%'
            ]) . "";
        // echo "</div>";
    } else {
        echo "This picture has been hidden by the Administrators.";
    }

    ?>

    <h4><b>Uploaded By:</b> <?= $user->username ?></h4>
    <h4><b>Company:</b> <?= $user->business_name ?></h4>
    <h4><b>Phone Number:</b> <?= $user->phone_number ?></h4>
    <h4><b>Uploaded At:</b> <?= $model->uploaded_at ?></h4>
    <h4><b>Likes:</b> <?= $model->likes ?></h4>
   
<!-- 
    TAGS
            'user_id',
            'description',
            'likes',
            'verified',
            'male',
            'female',
            'children',
            'formal_wear',
            'native',
            'aso_ebi',
            'groom_wear',
            'bridal_wear',
            'suit',
            'wedding_dress',
            'bridesmaid_dress',
            'bridal_accessory',
            'costume',
            'jewelry',
            'beads',
            'hairstyle',
            'cake',
            'decoration',
            'photography',

            'uploaded_at', 
        -->


<!-- endof main content--></div>
<!-- ad column _side_bar_ads--><div class="col-md-2"><?= $this->render('../layouts/_right_bar') ?></div>

