<?php

namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\ServiceImage;
// use app\models\ServiceSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'remove', 'picture', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'remove', 'picture', 'view'],
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Service::find()->where(['user_id' => yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

        // $searchModel = new ServiceSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    /**
     * Lists all Area models.
     * @return mixed
     */
    public function actionPicture($id)
    {

        $model = $this->findModel($id);

        if ($this->maximumPicture($id, $model->maximum_image)) {
            Yii::$app->session->setFlash('warning', 'You can not exceed a maximum picture upload of ' . $model->maximum_image . ' for this service. Contact the admin to increase this number.');            

            return $this->render('picture', [
                'model' => $model,
                'service_id' => $id,
            ]);
        }

        if (Yii::$app->request->isPost) {

            $picture = new ServiceImage;
            $picture->service_id = $id;

            if ($picture->load(Yii::$app->request->post())) {


                // get the uploaded file instance. for multiple file uploads
                // the following data will return an array
                $file = UploadedFile::getInstance($picture, 'image');

                if (is_null($file)) {
                    Yii::$app->session->setFlash('error', 'No file was selected.');            
                } 
                else if ($file->size > Yii::$app->params['maxFileSize']) {
                    $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                    Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 

                }else{
                   // store the source file name
                    //$picture->image = $file->name; //file name
                    $ext = end((explode(".", $file->name)));
                    // generate a unique file name
                    $picture->image = $picture->service_id .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    // $path = Yii::$app->params['uploadPath'] . $picture->image;
                    // $model->file->saveAs('services/' . $model->file->baseName . '.' . $model->file->extension);
                    $path = Yii::$app->params['serviceImagesPath'] . $picture->image;
 
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
            'service_id' => $id,
        ]);
    }

    /**
     * Displays a single Service model.
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
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($this->maximumService()) {
            Yii::$app->session->setFlash('warning', 'You can not exceed a maximum service of ' . yii::$app->user->identity->maximum_service . '. Contact the admin to increase this number.');            
            return $this->redirect(['index']);
        }

        $model = new Service();
        $model->user_id = yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function maximumService()
    {
        $count = Service::find()
                ->where(['user_id' => yii::$app->user->identity->id])
                ->count();

        if ($count < yii::$app->user->identity->maximum_service) {
            return false;
        }

        return true;
    }

    public function maximumPicture($serviceid, $maximum)
    {
        $count = ServiceImage::find()
                ->where(['service_id' => $serviceid])
                ->count();

        if ($count < $maximum) {
            return false;
        }

        return true;
    }

    /**
     * Updates an existing Service model.
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
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function containPicture($id){
        $count = ServiceImage::find()
                ->where(['service_id' => $id])
                ->count();

        if ($count == 0) {
            return false;
        }
        return true;
    }

    public function actionDelete($id)
    {
        if($this->containPicture($id)){
            Yii::$app->session->setFlash('warning', 'You must remove all pictures associated with a service before it can be deleted delete!.');
            return $this->redirect(['index']);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRemove($id, $sid)
    {
        
        if (($picture = $this->findPicture($id)) !== null) {
            $picture->delete();
            $path = Yii::$app->params['serviceImagesPath'] . $picture->image;
            if(is_file($path)){
                unlink($path);
            }
        }
        
        $model = $this->findModel($sid);

        return $this->render('picture', [
            'model' => $model,
            'service_id' => $sid,
        ]);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {

            if ($model->user_id != yii::$app->user->identity->id) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }else{
                return $model;
            }

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPicture($id)
    {
        if (($model = ServiceImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
