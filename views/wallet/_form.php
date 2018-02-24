<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Account;
use app\models\Bank;
use app\models\TransactionType;

use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Wallet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallet-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row"> <div class="col-lg-4">  <!-- first col -->

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'account')->dropDownList(
        ArrayHelper::map(Account::find()->all(), 'id', 'name'),
        ['prompt' => '---Select Account---']
    ) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'name' => 'date', 
                'value' => date('Y-m-d'),//, strtotime('-30 days')),
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    //'todayHighlight' => false,
                    'autoclose'=>true
            ]
        ]);
    ?>

    <?php //echo $form->field($model, 'description')->textInput(['maxlength' => 50]) ?>




    </div> <div class="col-lg-4">  <!-- second col -->

    <?= $form->field($model, 'credit')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'debit')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 19]) ?>



    </div> <div class="col-lg-4">  <!-- third col -->

    <?= $form->field($model, 'bank')->dropDownList(
        ArrayHelper::map(Bank::find()->all(), 'id', 'name'),
        ['prompt' => '---Select Bank---']
    ) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'transaction_type')->dropDownList(
        ArrayHelper::map(TransactionType::find()->all(), 'id', 'name'),
        ['prompt' => '---Select Transaction Type---']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Load Wallet' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>



    </div>  <!-- endof cols -->>

    
</div>

    <?php ActiveForm::end(); ?>

</div>
