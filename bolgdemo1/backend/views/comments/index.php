<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Commentssearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
            //'content:ntext',
            [
                'attribute'=>'content' ,
                'value'=>'begining',
                /*'value'=>function($model){
                    $str = strip_tags($model->content);
                    $strlen = mb_strlen($str);
                    return mb_substr($str,0,20,'utf-8').(($strlen>20)?'...':'');
                }*/
            ],
            [
                'label'=>'用户',
                'attribute'=>'username',
                'value'=>'users.username',
            ],
            //'status',
            [
                'attribute'=>'status',
                'value'=>'statu.name',
                'filter'=>\common\models\Commentstatus::find()
                    ->select(['name','id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
                'contentOptions'=>
                function($model){
                    return ($model->status==2)?['class'=>'bg-danger']:[];
                }
            ],
            //'create_time:datetime',
            [
                'attribute'=>'create_time',
                'format'=>['date','php:Y-m-d H:i:s'],
                'contentOptions'=>['width'=>'30px'],
            ],
            //'user_id',
            // 'email:email',
            // 'url:url',
            // 'artical_id',
            [
               'label'=>'文章标题',
                'value'=>'artical.title',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{approve}',
                'contentOptions'=>['width'=>'30px'],
                'buttons'=>
                    ['approve'=>function($url,$model,$key) {
                        $options = [
                            'title'=>Yii::t('yii','审核'),
                            'aria-label'=>Yii::t('yii','审核'),
                            'data-confirm'=>Yii::t('yii','您确定通过这条评论么'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                    }
            ],
            ],
        ],
    ]); ?>
</div>
