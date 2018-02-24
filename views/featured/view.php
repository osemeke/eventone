<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Featured */

$this->title = $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Featured', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="featured-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row"> <div class="col-lg-4">  <!-- first col -->


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'business_name',
            'phone_number',
            'end_date',
            'active',
            'sort_order',
            'picture',
            'description',
            'user_id',
            'email:email',
            'website',
            'address',
            'city',
            'state',
        ],
    ]) ?>

    </div> <div class="col-lg-4">  <!-- second col -->

        <?php echo Html::img('@web/images/services/' . $model->picture, ['alt' => '', 'width' => '200']) . ""; ?>

    </div> <div class="col-lg-4">  <!-- third col -->


    </div>  <!-- endof cols -->

</div>
