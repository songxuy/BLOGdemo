<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Articalsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artical-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            'title',
            [
                    'label'=>'作者',
                    'attribute'=>'autherName',
                    'value'=>'users.username',
            ],
            //'content:ntext',
            'tags:ntext',
            [
                'attribute'=>'status',
                'value'=>'statu.name',
                'filter'=>\common\models\Articalstatus::find()
                ->select(['name','id'])
                ->orderBy('position')
                ->indexBy('id')
                ->column(),
            ],
            //'status',
            // 'create_time:datetime',
            [
                    'attribute'=>'update_time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],

            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>
</div>
