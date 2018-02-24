<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

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
            'title',
            'business_name',
            'phone_number',
            'end_date',
            'active',
            'sort_order',
            'banner',
            'position',
            'email:email',
            'website',
            'address',

        ],
    ]) ?>

    </div> <div class="col-lg-4">  <!-- second col -->

<a href="#"><?= Html::img('@web/images/adverts/' . $model->banner .'', ['alt' => $model->title,'class'=>'img-responsive']) ?></a> 


    </div> <div class="col-lg-4">  <!-- third col -->



    </div>  <!-- endof cols -->


</div>
