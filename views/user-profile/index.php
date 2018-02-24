<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'role',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'first_name',
            // 'last_name',
            // 'middle_name',
            // 'gender',
            'business_name',
            // 'description',
            'phone_number',
            'email:email',
            // 'website',
            // 'address',
            // 'city',
            // 'state',
            // 'country',
            // 'referrer',
            // 'referrals',
            // 'blogs',
            // 'catalogs',
            // 'reputation',
            // 'maximum_service',
            // 'picture',
            // 'picture_extension',
            // 'active',
            // 'token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
