<?php

namespace app\controllers;

class AdminController extends \yii\web\Controller
{
    public function actionBan()
    {
        return $this->render('ban');
    }

    public function actionFeature()
    {
        return $this->render('feature');
    }

    public function actionFeatured()
    {
        return $this->render('featured');
    }

    public function actionHide()
    {
        return $this->render('hide');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPictures()
    {
        return $this->render('pictures');
    }

    public function actionUnban()
    {
        return $this->render('unban');
    }

    public function actionUnfeature()
    {
        return $this->render('unfeature');
    }

    public function actionVendors()
    {
        return $this->render('vendors');
    }

}
