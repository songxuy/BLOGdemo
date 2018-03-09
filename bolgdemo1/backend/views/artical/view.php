<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Artical */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定删除这篇文章么?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'content:ntext',
            'tags:ntext',
            //'status',
            [
               'label'=>'状态',
                'value'=>$model->statu->name,
            ],
           //' create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            //'update_time:datetime',
            [
                'attribute'=>'update_time',
                'value'=>date('Y-m-d H:i:s',$model->update_time),
            ],
            //'user_id',
            [
                'label'=>'作者',
                'value'=>$auther->username,
            ],
        ],
    ]) ?>

</div>
