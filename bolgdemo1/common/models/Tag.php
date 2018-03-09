<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public  static function string2array($tag)
    {
        return preg_split('/\s*,\s*/',trim($tag),-1,PREG_SPLIT_NO_EMPTY);
    }
    public  static function array2string($tag)
    {
        return implode(', ',$tag);
    }
    public static function addTags($tag)
    {
        if(empty($tag)) return;

        foreach($tag as $name)
        {
            $aTag = Tag::find()->where(['name'=>$name])->one();
            $aTagCount = Tag::find()->where(['name'=>$name])->count();
            if(!$aTagCount)
            {
                $tag = new Tag;
                $tag->name = $name;
                $tag->frequency=1;
                $tag->save();
            }else{
                $aTag->frequency +=1;
                $aTag->save();

            }
        }
    }

    public static function removeTags($tag)
    {
        if(empty($tag)) return;

        foreach($tag as $name)
        {
            $aTag = Tag::find()->where(['name'=>$name])->one();
            $aTagCount = Tag::find()->where(['name'=>$name])->count();
            if($aTagCount)
            {
                if($aTagCount && $aTag->frequency<=1)
                {
                    $aTag->delete();
                }else{
                    $aTag->frequency -=1;
                    $aTag->save();
                }
            }
        }
    }

    public static  function updateFrequncy($oldTags,$newTags)
    {
        if(!empty($oldTags) || !empty($newTags))
        {
            $oldTagsarray = self::string2array($oldTags);
            $newTgsarray = self::string2array($newTags);

            self::addTags(array_values(array_diff($newTgsarray,$oldTagsarray)));
            self::removeTags(array_values(array_diff($oldTagsarray,$newTgsarray)));
        }
    }

    public static  function findTagWeight($limit=20){
        $tag_size = 5;
        $models = Tag::find()->orderBy('frequency desc')->limit($limit)->all();
        $total = Tag::find()->limit($limit)->count();
        $stepper = ceil($total/$tag_size);
        $tags = array();
        $count = 1;
        if($total>0){
            foreach ($models as $model){
                $weight = ceil($count/$stepper)+1;
                $tags[$model->name]=$weight;
                $count++;
            }
            ksort($tags);
        }
        return $tags;
    }
}
