<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Articalsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <ol class="breadcrumb" style="background-color: #ffffff">
                <li><a href="<?= Yii::$app->homeUrl;?>">首页</a></li>
                <li><a href="<?= Yii::$app->homeUrl;?>?r=artical/index">文章列表</a></li>
                <li class="active"><?= $model->title;?></li>
            </ol>

            <div class="artical">
                <div class="title">
                    <h2><a href="<?=$model->url;?>"><?=Html::encode($model->title)?></a></h2>
                </div>
                <div class="auther">
                    <span class="glyphicon glyphicon-time"></span><em><?= date('Y-m-d H:i:s',$model->create_time); ?></em>
                    <span class="glyphicon glyphicon-user" style="margin-left:10px;"></span><em><?= Html::encode($model->users->username); ?></em>
                </div>
                <br>
                <div class="content">
                    <span>
                    <?=
                    HtmlPurifier::process(nl2br($model->content))?></span>
                </div>

                <div class="nav" style="margin-top:30px;">
                    <span class="glyphicon glyphicon-tag"></span>
                    <?= implode(',',$model->tagLinks);?>
                    <br>
                    <?= Html::a("评论({$model->commentCount})",$model->url.'#comments');?> | 最后修改于<?= date('Y-m-d H:i:s',$model->update_time); ?>
                </div>

                <div class="comment">
                    <?php if($added){ ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>谢谢您的回复，我们会尽快审核后发布出来</h4>
                        <span class="glyphicon glyphicon-time"></span><em><?= date('Y-m-d H:i:s',$model->create_time); ?></em>
                        <span class="glyphicon glyphicon-user" style="margin-left:10px;"></span><em><?= Html::encode($model->users->username); ?></em>
                    </div>
                    <?php }?>
                </div>


                <?php if($model->commentCount>=1):?>
                <h5><?= $model->commentCount.'条评论';?></h5>
                <?=
                    $this->render('_comment',array(
                    //'post'=>$model,
                    'comments'=>$model->activeComments,
                ));?>

                <?php endif;?>

                <h5>发表评论</h5>
                <?php
                $postComment = new \common\models\Comments();
                echo $this->render('_guestform',array(
                        'id'=>$model->id,
                    'commentModel'=>$postComment,
                ));
                ?>
            </div>

        </div>
        <div class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span>查找文章
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
                        <?= \frontend\components\Rccommentswight::widget(['recentComments'=>$recentComment])?>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
