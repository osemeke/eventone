<?php
namespace app\models;
use Yii;

class PermissionHelpers {

    public static function requireSuperAdmin() {

        if(Yii::$app->user->identity->role == 1)
        {
            return true;
        }
        else return false;
    }

    public static function requireAdmin() {

        if(Yii::$app->user->identity->role <= 2)
        {
            return true;
        }
        else return false;
    }
} 

// at top with your other use
// use yii\filters\AccessControl;
// use app\models\PermissionHelpers;


// // first function inside the class
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
//And now you need to update yourself in the DB with role = 100, and you're set.
