<?php

namespace app\controllers;

use Yii;
use app\models\TargetedAdvert;
use app\models\Wallet;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TargetedAdvertController implements the CRUD actions for TargetedAdvert model.
 */
class TargetedAdvertController extends Controller
{

    public function price(){ return 200; }

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
     * Lists all TargetedAdvert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TargetedAdvert::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TargetedAdvert model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->redirect(['index']);
    }

    /**
     * Creates a new TargetedAdvert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $price = $this->price();
        $model = new TargetedAdvert();
        $model->user_id = yii::$app->user->identity->id;

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {

                $file = \yii\web\UploadedFile::getInstance($model, 'file');
                $cost = $model->days * $price;

                if (is_null($file)) {

                    Yii::$app->session->setFlash('error', 'No file was selected.');

                } 
                else if ($file->size > Yii::$app->params['maxFileSize']) {

                    $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                    Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 

                }
                else if (!$this->walletCanFund($model->user_id, $cost)) { 

                    Yii::$app->session->setFlash('error', 'Unable to create advert. You have not enough funds. You need NGN' . number_format($cost, 2) . ' for ' . $model->days . ' day(s)'); 

                }else{

                    // end date
                    $date = date_create($model->start_date);
                    date_add($date, date_interval_create_from_date_string($model->days . " days"));
                    $model->end_date = date_format($date, "Y-m-d");
                    // image link
                    $ext = end((explode(".", $file->name)));
                    $model->image_link = rand(1,9) .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                    $path = 'images/targetedads/' . $model->image_link;
 
                    if($model->save()){

                        $file->saveAs($path);

                        // billing code
                        $this->debitUser($model->user_id, $cost);

                        return $this->redirect(['update', 'id'=>$model->id]);

                    } else {

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
     * Updates an existing TargetedAdvert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $price = $this->price();
        $model->user_id = yii::$app->user->identity->id;

        if(!$this->userIsAuthorized($model->user_id)){
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post())) {
                $file = \yii\web\UploadedFile::getInstance($model, 'file');
                $cost = $model->days * $price;

                if (!is_null($file)) {

                    if ($file->size > Yii::$app->params['maxFileSize']) {

                        $kb = round(Yii::$app->params['maxFileSize'] / 1024); 
                        Yii::$app->session->setFlash('error', 'Error in saving picture. Maximum file size allowed is ' . $kb . 'KB.'); 

                    }
                    else if (!$this->walletCanFund($model->user_id, $cost)) { 

                        Yii::$app->session->setFlash('error', 'Unable to update advert. You have not enough funds. You need NGN' . number_format($cost, 2) . ' for ' . $model->days . ' day(s)'); 

                    } else {

                        // end date
                        $date = date_create($model->start_date);
                        date_add($date, date_interval_create_from_date_string($model->days . " days"));
                        $model->end_date = date_format($date, "Y-m-d");

                        // image link
                        $ext = end((explode(".", $file->name)));
                        $old_file = $path = 'images/targetedads/' . $model->image_link;
                        // generate a unique file name
                        $model->image_link = rand(1,9) .'-'. Yii::$app->security->generateRandomString().".{$ext}";
                        $path = 'images/targetedads/' . $model->image_link;

                        if ($file->saveAs($path)) {
                            $model->save();    
                            if(is_file($old_file)) { unlink($old_file); }

                        }else{
                            Yii::$app->session->setFlash('error', 'Error in updating advert.'); 

                        }
                    }
                } else {
                    $model->save();
                }

                // billing code
                $this->debitUser($model->user_id, $cost);
            }
        }

        return $this->render('update', [
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

    public function walletCanFund($userid, $cost){
        $querybuilder = (new \yii\db\Query())->from('wallet')->where(['user_id' => $userid]);
        $credit = $querybuilder->sum('credit');
        $debit = $querybuilder->sum('debit');
        $balance = $credit - $debit;

        if($cost <= $balance) {
            return true;
        }

        return false;
    }

    public function debitUser($userid, $amount){
        $model = new Wallet();

        $model->user_id = $userid;
        $model->username = 'o';
        $model->account = 1;
        $model->date = date("Y-m-d");
        $model->description = "User: " . $userid . ". Targeted Advert.";
        $model->balance = 0.00 ;
        $model->credit = 0.00 ;
        $model->debit = $amount;
        $model->bank = 1;
        $model->transaction_type = 1;

        if(!$model->save()){ echo "Oooops!!! There was an unknown problem!"; exit;}       
    }
    
    /**
     * Deletes an existing TargetedAdvert model.
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

        $file = $path = 'images/targetedads/' . $model->image_link;

        if (is_file($file)) {
            unlink($file);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TargetedAdvert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TargetedAdvert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TargetedAdvert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
