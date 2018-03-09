<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comments;

/**
 * Commentssearch represents the model behind the search form about `common\models\Comments`.
 */
class Commentssearch extends Comments
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['username']); // TODO: Change the autogenerated stub
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'user_id', 'artical_id'], 'integer'],
            [['content', 'email', 'url','username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Comments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>5],
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>'SORT_DESC',
                ],
                // 'attributes'=>['id','title','autherName'],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'comments.id' => $this->id,
            'comments.status' => $this->status,
            'create_time' => $this->create_time,
            'user_id' => $this->user_id,
            'artical_id' => $this->artical_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url]);

            $query->join('INNER JOIN', 'User', 'Comments.user_id =User.id');
            $query->andFilterWhere(['like', 'User.username', $this->username]);
            $dataProvider->sort->attributes['username'] = [
                'asc' => ['User.username' => SORT_ASC],
                'desc' => ['User.username' => SORT_DESC],
            ];
        $dataProvider->sort->defaultOrder=
            [
                'status'=>SORT_DESC,
                'id'=>SORT_DESC,
            ];
        return $dataProvider;
    }
}