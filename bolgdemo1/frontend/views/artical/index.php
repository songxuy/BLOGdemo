<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Articalsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title='文章列表';
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <ol class="breadcrumb" style="background-color: #ffffff">
                <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
                <li>文章列表</li>
            </ol>
            <ul class="main_ul col-md-12">
            <?= \yii\widgets\ListView::widget([
                    'id'=>'articalList',
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'_listitem',
                    'layout'=>'{items}{pager}',
                    'pager'=>[
                        'maxButtonCount'=>10,
                        'nextPageLabel'=>Yii::t('app','下一页'),
                        'prevPageLabel'=>Yii::t('app','上一页'),
                    ]
            ]) ?>
            </ul>
        </div>
        <div class="col-md-3">
            <div class="searchbox">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="glyphicon glyphicon-search"></span>查找文章(<?php
                        $data = Yii::$app->cache->get('postcount');
                        $depend = new \yii\caching\DbDependency(['sql'=>'select count(id) from artical']);
                        if($data ===false){
                            $data = \common\models\Artical::find()->count();
                            Yii::$app->cache->set('postcount',$data,60,$depend);
                        }
                        echo $data;
                    ?>)
                </li>
                <li class="list-group-item">
                    <form class="form-inline" action="index.php?r=artical/index" id="w0" method="get">
                        <div class="row">
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" name="Articalsearch[title]" id="w0input" placeholder="按标题">
                        </div>
                        <button type="submit" class="btn btn-default col-md-3 col-md-offset-1">搜索</button>
                        </div>
                    </form>
                </li>

            </ul>
            </div>

            <div class="tagbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-tag"></span>标签云
                    </li>
                    <li class="list-group-item">
                        <?= \frontend\components\TagsCloudWight::widget(['tags'=>$tags])?>
                    </li>

                </ul>
            </div>

            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-comment"></span>最新回复
                    </li>
                    <li class="list-group-item">
                        <?= \frontend\components\Rccommentswight::widget(['recentComments'=>$recentComments])?>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
