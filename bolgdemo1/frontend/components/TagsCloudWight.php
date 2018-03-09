<?php
namespace  frontend\components;

use yii\Base\widget;
use yii\helpers\Html;

class TagsCloudWight extends Widget{
    public $tags;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $tagString ='';
        $fontStyle =array('6'=>'danger',
            '5'=>'info',
            '4'=>'warning',
            '3'=>'primary',
            '2'=>'success'
            );
        foreach ($this->tags as $tag => $wight){
            $tagString .= '<a href="'.\Yii::$app->homeUrl.'?r=artical/index&Articalsearch[tags]='.$tag.'"> <h'.
                $wight.' style="display:inline-block;"><span class="label label-'.$fontStyle[$wight].'">'.$tag.'</span></h'.$wight.'></a>';
        }
        return $tagString;
    }
}