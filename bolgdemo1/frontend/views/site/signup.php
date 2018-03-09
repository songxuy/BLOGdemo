<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

$this->title = '注册';
AppAsset::addCss($this,Yii::$app->request->baseUrl."/css/reg.css");
?>
<div class="site-signup">

    <div class="row main">
        <div class="login_left">
            <div class="img_mask"></div>
            <div class="login_left_content">
                <div class="content_logo">
                    <a><i class="glyphicon glyphicon-apple" style="color:#ffffff;font-size: 30px;z-index: 4;"></i><i class="glyphicon glyphicon-grain" style="color:#ffffff;font-size: 30px;z-index: 4;"></i><i class="glyphicon glyphicon-apple" style="color:#ffffff;font-size: 30px;z-index: 4;"></i></a>
                </div>
                <div class="conten_word">
                    <p>我心中已经听到来自远方的呼唤，再不需要回过头去关心身后的种种是非。</p>
                    <div class="login_author">米兰·昆德拉</div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-lg-offset-6" style="margin-top:50px;">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>请填写下面的区域来完成注册</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
