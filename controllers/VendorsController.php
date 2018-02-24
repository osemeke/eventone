<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategoryGroup;
use app\models\Service;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class VendorsController extends Controller
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

    public function actionCategory($id)
    {
        $category = Category::findOne($id);
        $query = Service::find()
                ->where(['category_id' => $id, 'hidden' => 0]);

        //$model = $query->all();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('category', [
                'group_id' => $category->category_group_id,
                'group' => $category->categoryGroup->name,
                'category' => $category->name,
                'model' => $model,
                'count' => $countQuery->count(),
                'pages' => $pages, // pagination
            ]);
    }

    public function actionGroup($id)
    {
        $group = CategoryGroup::findOne($id);
        // print_r($group->categories[0]);
        $category_id_array = ArrayHelper::getColumn(Category::find()->where(['category_group_id' => $id])->all(), 'id');
        // var_dump($category_id_array);

        // exit;
        $query = Service::find()
                ->where(['category_id' => $category_id_array, 'hidden' => 0]);
                //->where(['category_id' => [1,21,50], 'hidden' => 0]);

        //$model = $query->all();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('group', [
                'group' => $group->name,
                'model' => $model,
                'count' => $countQuery->count(),
                'pages' => $pages, // pagination
                'categoryidarray' => $category_id_array,
            ]);
    }

    public function actionView($id)
    {
        $model = Service::findOne($id);

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $description
 * @property string $minimum_price
 * @property string $maximum_price
 * @property integer $hidden
 * @property integer $maximum_image
 * @property integer $hit_count
 *
 * @property Category $category
 * @property User $user
 * @property ServiceImage[] $serviceImages
 */
        return $this->render('view', [
                //'group' => $group->name,
                'model' => $model,
            ]);

    }

    public function actionAll()
    {
        return $this->render('all');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
