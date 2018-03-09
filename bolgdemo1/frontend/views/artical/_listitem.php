<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::addCss($this,Yii::$app->request->baseUrl."/css/main.css");
AppAsset::addJs($this,Yii::$app->request->baseUrl."/js/list.js");
?>
<!--<div class="artical">
    <div class="title">
        <h2><a href="<?= $model->url;?>"><?=

                Html::encode($model->title);
                ?></a></h2>
        <div class="auther">
            <span class="glyphicon glyphicon-time"></span><em><?=date('Y-m-d H:i:s',$model->create_time); ?></em>
            <span class="glyphicon glyphicon-user" style="margin-left:10px;"></span><em><?= Html::encode($model->users->username); ?></em>
        </div>

        <div class="content">
            <?= $model->beginging;?>
        </div>
        <br>
        <div class="nav">
            <span class="glyphicon glyphicon-tag"></span>
            <?= implode(',',$model->tagLinks);?>
            <br>
            <?= Html::a("评论({$model->commentCount})",$model->url.'#comments');?> | 最后修改于<?= date('Y-m-d H:i:s',$model->update_time); ?>
        </div>
    </div>
</div>-->
    <li>
        <div class="tetx">
            <h2><a href="<?= $model->url;?>"><?=

                    Html::encode($model->title);
                    ?></a></h2>
            <dl>
                <dd class="tag">
                    <a><?= implode(',',$model->tagLinks);?></a>
                </dd>
                <dd>
                    <a><img src="../images/logo.jpg"></a>
                </dd>
                <dd class="name">
                    <a style="color:#999;">
                        AI科技大本营                            </a>
                </dd>
                <dd class="time">
                    <a style="color:#999;">
                        <span class="glyphicon glyphicon-time"></span><?= date('Y-m-d',$model->create_time); ?>                            </a>
                </dd>
                <dd class="strateg">
                    <a style="color:#999;">
                        运营精选                                                    </a>
                </dd>
                <dd class="read_number">
                    <a style="color:#999;">
                        <i class="glyphicon glyphicon-book"></i> 6722                            </a>
                </dd>
                <dd class="comn_number">
                    <a style="color:#999;">
                        <i class="glyphicon glyphicon-comment"></i> <?= Html::a("{$model->commentCount}",$model->url.'#comments');?>                          </a>
                </dd>
                <dd class="close_tag">
                    <div class="reason">
                        <i class="glyphicon glyphicon-remove" style="cursor: pointer;"></i>
                        <div class="unin_reason_dialog" style="">
                            <h3>选择理由，精准屏蔽</h3>
                            <ul>
                                <li class="unin_item csdn-tracking-statistics" >
                                    <a target="_blank" style="color:#999;">所属分类<em style="font-style:normal;color:#4f4f4f;"> 其他</em> 不感兴趣</a>
                                </li>
                                <br>
                                <li class="unin_item csdn-tracking-statistics" >
                                    <a target="_blank" style="color:#999;">推荐理由<em style="font-style:normal;color:#4f4f4f;">运营精选</em>不准确</a>
                                </li>
                                <br>
                                <li class="unin_item csdn-tracking-statistics">
                                    <a target="_blank" style="color:#999;"> 旧闻、重复 </a>
                                </li>
                                <br>
                                <li class="unin_item csdn-tracking-statistics">
                                    <a target="_blank" style="color:#999;"> 内容质量差 </a>
                                </li>
                                <br>
                            </ul>
                        </div>
                    </div>
                </dd>
            </dl>
        </div>
    </li>
