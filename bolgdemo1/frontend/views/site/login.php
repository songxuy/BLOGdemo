<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

$this->title = '登录';
AppAsset::addCss($this,Yii::$app->request->baseUrl."/css/login.css");
?>
<!--<div class="site-login">

    <div class="row">
        <div class="col-lg-5">
            <?/*php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;position: relative;top:-32px;left:350px;">
                     <?= Html::a('忘记密码', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); */?>
        </div>
    </div>
</div>-->
<div class="main">
        <div clas="row">
            <div class="login_banner col-md-6" style="margin-left:50px;">
                <a><img src="../images/login.png" height="510px;"></a>
            </div>
            <div class="login_user col-md-5">
                <div class="login_part">
                    <h3>账号登录</h3>
                    <div class="user_info" style="padding: 0 30px;">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="color:#999;position: relative;top:-32px;left:270px;">
                            <?= Html::a('忘记密码', ['site/request-password-reset']) ?>.
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('登录', ['class' => 'login', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="line"></div>
                    <div class="third_part">
                        <span>第三方账号登录</span>
                        <a id="qqAuthorizationUrl" href="" class="qq" target="_blank"><img src="../images/login-third-party-new.png"></a>

                    </div>
                </div>
            </div>
        </div>
</div>