<?php
namespace console\controllers;

use common\models\Artical;
use Yii;
use yii\console\Controller;

class HelloController extends  Controller{
    public function actionIndex(){
        echo "hello world";
    }

    public function actionList(){
        $artical = Artical::find()->all();
        foreach($artical as $a){
            echo ($a['id']."-".$a['title']."\n");
        }
    }

    public function actionWho($name){
        echo ('hello'.$name."\n");
    }
}