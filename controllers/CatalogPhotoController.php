<?php

namespace app\controllers;

use Yii;
use app\models\CatalogPhoto;
use app\models\CatalogPhotoSearch;
use app\models\CatalogSearch;
use app\models\TargetedAdvert;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CatalogPhotoController implements the CRUD actions for CatalogPhoto model.
 */
class CatalogPhotoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],               
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all CatalogPhoto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogPhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatalogPhoto model.
     * @param integer $id
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new CatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $ad = $this->randomTargetedAdvert();

        return $this->render('search', [
            'image_link' => $ad['banner'],
            'website_link' => $ad['website'],
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $dataProvider->getModels(),
        ]);
    }

    /**
     * Displays a single CatalogPhoto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function randomTargetedAdvert()
    {
        $date = date("Y-m-d");

        $ads = TargetedAdvert::find()
        // $ads = TargetedAdvert::find()->where(['category_id' => $category_array])
            ->where('active = :active AND end_date >= :today_date AND start_date <= :today_date', [':today_date' => $date, ':active' => 1])
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

    /**
     * Creates a new CatalogPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogPhoto();
        $model->user_id = yii::$app->user->identity->id;

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {

                // get the uploaded file instance. for multiple file uploads
                // the following data will return an array
                $file = \yii\web\UploadedFile::getInstance($model, 'file');

                if (is_null($file)) {
                    Yii::$app->session->setFlash('error', 'No file was selected.');            
                } 
                else if ($file->size > Yii::$app->params['maxFileSize']) {
                    $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                    Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 

                }else{
                   // store the source file name
                    //$model->image_link = $file->name; //file name
                    $ext = end((explode(".", $file->name)));
                    // generate a unique file name
                    $model->image_link = rand(1,9) .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    // $path = Yii::$app->params['uploadPath'] . $model->image_link;
                    // $model->file->saveAs('services/' . $model->file->baseName . '.' . $model->file->extension);
                    $path = 'images/catalogs/' . $model->image_link;
 
                    if($model->save()){
                        $file->saveAs($path);
                        return $this->redirect(['update', 'id'=>$model->id]);
                    } else {
                        // error in saving picture
                        Yii::$app->session->setFlash('error', 'Error in saving picture.'); 
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CatalogPhoto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function userIsAuthorized($userid){

        if(Yii::$app->user->identity->role <= 2) {
            return true;
        }
        
        if(Yii::$app->user->identity->id == $userid) {
            return true;
        }

        return false;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(!$this->userIsAuthorized($model->user_id)){
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {
                $file = \yii\web\UploadedFile::getInstance($model, 'file');

                if (!is_null($file)) {
                    //Yii::$app->session->setFlash('error', 'No file was selected.');            

                    if ($file->size > Yii::$app->params['maxFileSize']) {
                        $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                        Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 
                    } else {
                        $ext = end((explode(".", $file->name)));
                        $old_file = $path = 'images/catalogs/' . $model->image_link;
                        // generate a unique file name
                        $model->image_link = rand(1,9) .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                        $path = 'images/catalogs/' . $model->image_link;

                        if ($file->saveAs($path)) {
                            $model->save();    
                            if(is_file($old_file)) { unlink($old_file); }

                        }else{
                            Yii::$app->session->setFlash('error', 'Error in updating picture.'); 

                        }
                    }
                } else {
                    $model->save();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CatalogPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if(!$this->userIsAuthorized($model->user_id)){
            return $this->redirect(['index']);
        }

        $model->delete();

        $file = $path = 'images/catalogs/' . $model->image_link;

        if (is_file($file)) {
            unlink($file);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the CatalogPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogPhoto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
