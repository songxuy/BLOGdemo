<?php
namespace  frontend\components;

use yii\Base\widget;
use yii\helpers\Html;

class Rccommentswight extends Widget{
    public $recentComments;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $comentString ='';
        foreach ($this->recentComments as $comments){
            $comentString .= '<div class="post">'.'<div class="title">'.
                '<p style="color:#777777;font-style:italic;">'.
                nl2br($comments->content).'</p>'.
                '<p class="text"><span class="glyphicon glyphicon-user"></span>'.Html::encode($comments->users->username).'</p>'.
               '<p style="font-size:8pt;color:blue">《<a href="'.$comments->url.'">'.Html::encode($comments->artical->title).'</a>》</p>'.
                '<hr></div></div>';

        }

        return $comentString;
    }
}