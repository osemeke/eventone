<?php

namespace app\controllers;

use Yii;
use app\models\Advert;
use app\models\AdvertSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\PermissionHelpers;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                                return PermissionHelpers::requireAdmin();
                            }
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
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advert model.
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
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advert();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post()); 

            if ($model->validate()) {                
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('images/adverts/' . $model->file->baseName . '.' . $model->file->extension);
                $model->banner = $model->file->baseName . '.' . $model->file->extension; 
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
            return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post()); 

            if ($model->validate()) {                
                $model->file = UploadedFile::getInstance($model, 'file');
                 // var_dump($model->file); exit;               

                if ($model->file != null) {
                    $path = 'images/adverts/' . $model->banner;

                    if(is_file($path)){
                        unlink($path);
                    }

                    $model->file->saveAs('images/adverts/' . $model->file->baseName . '.' . $model->file->extension);
                    $model->banner = $model->file->baseName . '.' . $model->file->extension;  
                }

                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
            return $this->render('update', ['model' => $model,]);        
    }

    /**
     * Deletes an existing Advert model.
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
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
