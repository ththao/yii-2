<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Newsletter;

/**
* NewsletterSearch represents the model behind the search form about `common\models\Newsletter`.
*/
class NewsletterSearch extends Newsletter
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'role_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['subject', 'content'], 'safe'],
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
$query = Newsletter::find()->orderBy(['id' => SORT_DESC]);

$dataProvider = new ActiveDataProvider([
'query' => $query,
'pagination' => [
'pageSize' => Yii::$app->params['pageSize'],
],
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to return any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'role_id' => $this->role_id,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);


return $dataProvider;
}
}
