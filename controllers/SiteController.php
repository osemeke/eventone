<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Featured;
use app\models\CategoryGroup;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use yii\rbac\DbManager;
use app\models\PermissionHelpers;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout', 'signup','forgot-password'],
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // [
                    //     'actions' => ['forgot-password'],
                    //     'allow' => true,
                    //     'roles' => ['@'],
                    //     'matchCallback' => function($rule, $action) {
                    //             return PermissionHelpers::requireAdmin();
                    //         }
                    // ],                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
// public function behaviors()
// {
//     return [
//         'access' => [
//             'class' => AccessControl::className(),
//             'only' => ['privateaction1', 'privateaction2'],
//             'rules' => [
//                 [
//                     'actions' => ['privateaction1', 'privateaction2'],
//                     'allow' => true,
//                     'roles' => ['@'],
//                     'matchCallback' => function($rule, $action) {
//                             return PermissionHelpers::requireAdmin();
//                         }
//                 ],
//             ],
//         ],
// }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // $group = CategoryGroup::findOne($id);
        // // print_r($group->categories[0]);
        // $user_id_array = ArrayHelper::getColumn(User::find()->where(['category_group_id' => $id])->all(), 'id');
        // // var_dump($category_id_array);

        // // exit;
        // $model = Service::find()
        //         ->where(['user_id' => $user_id_array, 'hidden' => 0])
        //         ->all();
        //         //->where(['category_id' => [1,21,50], 'hidden' => 0]);

        // //$model = $query->all();
        // // $countQuery = clone $query;
        // // $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        // // $model = $query->offset($pages->offset)
        // //     ->limit($pages->limit)
        // //     ->all();
       $model = Featured::find()
                ->where(['active' => 1])
                ->all();
                //->where(['category_id' => [1,21,50], 'hidden' => 0]);

        return $this->render('index', [
                'featured' => $model,
                // 'count' => $countQuery->count(),
                // 'pages' => $pages, // pagination
            ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionPrivacy()
    {
        return $this->render('privacy');
    }
    public function actionTerms()
    {
        return $this->render('terms');
    }
    public function actionAffiliate()
    {
        return $this->render('affiliate');
    }
    
    public function actionFaqs()
    {
        $model = \app\models\Faq::find()->orderBy('sort_order')->all();

        return $this->render('faqs', [
            'model' => $model,
        ]);
    }

    public function actionVerification($id)
    {
        $m='';
        $query = User::find()->where(['token' => $id, 'status' => 0, 'active' => 0]);
            
        if ($query->count() == 1 && $id != 'verified') { //check if passkey exist
            //if exist set active to 1 and add auth assignment
            $uid = $query->one()->id;
            $user = User::findOne($uid);

            $user->active = 1;
            $user->status = 1;
            $user->token = 'verified';
            $user->save();

            //role assignment 
            // $rbac = new DbManager;
            // $rbac->init();
            // $role = $rbac->getRole('vendor');
            // //$rbac->add($test);

            // $rbac->assign($role, $uid);

            // $updated_user = User::findOne($uid);

            //set flash if not exist
            Yii::$app->getSession()->setFlash('success', 'Email verification successful! You can now login.');
            // $m=$updated_user->token.'-----'.$updated_user->active;
        }else{
            Yii::$app->getSession()->setFlash('error', 'Email verification process failed!.');
        }

        return $this->render('verification', [
            'user_id' => $m,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }
//exit;

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        //generate passkey
        $model->token = Yii::$app->security->generateRandomString();

        if ($model->load(Yii::$app->request->post())) {


            if ($user = $model->signup()) {

                //send email
                $body = "<p>
Thank you for registering for an account on " . (Yii::$app->params['siteName']) . ".<br />
</p>
<p>
Your username is: " . $model->username . "<br />
Your password is: " . $model->password . "<br />
</p>
<p>
Ccomplete your registration before you can login.<br />
</p>
<p>
In order to complete your registration, verify your email address by clicking the link below
</p>
<p>
    <a href=\"" . (\yii\helpers\Url::toRoute('site/verification', true)) . "/?id=" . $model->token . "\">Confirm email address</a>.
</p>

<p>
If you have not registered for an account on this web site<br />
and believe that you have received this email eroneously,<br />
please report this to " . (Yii::$app->params['supportEmail']) . ".<br />
-----------------------------------------------------------<br />
This message was sent by " . (Yii::$app->params['siteName']) . " which is powered by " . (Yii::$app->params['companyName']) . ".<br />
</p>
                        ";

                mail($model->email, "New Registration Email Confirmation", $body);

                //if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                //}
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionForgotPassword()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
}
