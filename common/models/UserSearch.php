<?php

namespace common\models;

use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public function rules()
    {
        return [
            [['username','first_name','last_name','phone','email','status'],'safe']
        ];
    }

    public function search($params)
    {
        $query = User::find()->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,

            ]
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like','first_name',$this->first_name])
            ->andFilterWhere(['like','last_name',$this->last_name])
            ->andFilterWhere(['like','phone',$this->phone])
            ->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }
}