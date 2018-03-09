<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Artical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artical-form">

    <?php $form = ActiveForm::begin([
        'action'=>['artical/detail','id'=>$id,'#'=>'comments'],
        'method'=>'post'
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($commentModel,'content')->textarea(['row'=>4])?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($commentModel->isNewRecord ? '发布' : '修改', ['class' => $commentModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
