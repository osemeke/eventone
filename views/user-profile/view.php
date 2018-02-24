<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Feature', ['featured/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'role',
            'status',
            'created_at',
            'updated_at',
            'first_name',
            'last_name',
            'middle_name',
            'gender',
            'business_name',
            'description',
            'phone_number',
            'email:email',
            'website',
            'address',
            'city',
            'state',
            'country',
            'referrer',
            'referrals',
            'blogs',
            'catalogs',
            'reputation',
            'maximum_service',
            'picture',
            'picture_extension',
            'active',
            'token',
        ],
    ]) ?>

</div>
