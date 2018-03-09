<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Artical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artical-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    <?php
    //第一种方法
    /*$obj = \common\models\Articalstatus::find()->all();
    $allstatus = \yii\helpers\ArrayHelper::map($obj,'id','name');*/
    //第二种
    $allstatus = (new \yii\db\Query())
    ->select(['name','id'])
    ->from('articalstatus')
    ->indexBy('id')
    ->column();
    ?>
    <?= $form->field($model,'status')->dropDownList($allstatus,['prompt'=>'请选择状态']); ?>

    <?php
    $auther = \common\models\User::findOne($model->user_id); ?>

    <?= $form->field($auther,'username')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
