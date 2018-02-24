<?php

namespace app\controllers;

use Yii;
use app\models\PhotoCatalog;
use app\models\PhotoCatalogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhotoCatalogController implements the CRUD actions for PhotoCatalog model.
 */
class PhotoCatalogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhotoCatalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotoCatalogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhotoCatalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PhotoCatalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhotoCatalog();
        $model->user_id = yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhotoCatalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhotoCatalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Lists all Area models.
     * @return mixed
     */
    public function actionPicture($id)
    {

        $model = $this->findModel($id);

        // if ($this->maximumPicture($id, $model->maximum_image)) {
        //     Yii::$app->session->setFlash('warning', 'You can not exceed a maximum picture upload of ' . $model->maximum_image . ' for this service. Contact the admin to increase this number.');            

        //     return $this->render('picture', [
        //         'model' => $model,
        //         'service_id' => $id,
        //     ]);
        // }

        if (Yii::$app->request->isPost) {

            $picture = new \app\models\CatalogImage;

            $picture->photo_catalog_id = $id;

            if ($picture->load(Yii::$app->request->post())) {


                // get the uploaded file instance. for multiple file uploads
                // the following data will return an array
                $file = \yii\web\UploadedFile::getInstance($picture, 'image_link');

                if (is_null($file)) {
                    Yii::$app->session->setFlash('error', 'No file was selected.');            
                } 
                else if ($file->size > Yii::$app->params['maxFileSize']) {
                    $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                    Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 

                }else{
                   // store the source file name
                    //$picture->image_link = $file->name; //file name
                    $ext = end((explode(".", $file->name)));
                    // generate a unique file name
                    $picture->image_link = $picture->photo_catalog_id .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    // $path = Yii::$app->params['uploadPath'] . $picture->image_link;
                    // $model->file->saveAs('services/' . $model->file->baseName . '.' . $model->file->extension);
                    $path = 'images/catalogs/' . $picture->image_link;
 
                    if($picture->save()){
                        $file->saveAs($path);
                        // return $this->redirect(['view', 'id'=>$picture->_id]);
                    } else {
                        // error in saving picture
                        Yii::$app->session->setFlash('error', 'Error in saving picture.');            

                    }
                }
            }
        }

        return $this->render('picture', [
            'model' => $model,
            'photo_catalog_id' => $id,
        ]);
    }

    /**
     * Finds the PhotoCatalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhotoCatalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhotoCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
