<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $user_id
 * @property string $email
 * @property string $url
 * @property integer $artical_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'create_time', 'user_id', 'artical_id'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'status' => '状态',
            'create_time' => '创建时间',
            'user_id' => '用户',
            'email' => '电子邮件',
            'url' => 'Url',
            'artical_id' => '文章',
        ];
    }
    public function getUsers()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getArtical()
    {
        return $this->hasOne(Artical::className(),['id'=>'artical_id']);
    }
    public function getStatu()
    {
        return $this->hasOne(Commentstatus::className(),['id'=>'status']);
    }

    public function getBegining()
    {
        $str = strip_tags($this->content);
        $strlen = mb_strlen($str);
        return mb_substr($str,0,20,'utf-8').(($strlen>20)?'...':'');
    }
    public function approve(){
        $this->status =1;
        return ($this->save()?true:false);
    }
    public static function getUnpasscount(){
        return Comments::find()->where(['status'=>2])->count();
    }
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->create_time=time();
            }
            return true;
        }else{
            return false;
        }
    }

    public static  function findRecentComments($limit=10){
        return Comments::find()->where(['status'=>1])->orderBy('create_time DESC')->limit($limit)->all();
    }
}
