<?php

namespace frontend\models\search;

use common\models\User;
use frontend\models\Course;
use yii\data\ActiveDataProvider;

class CourseSearch extends Course
{
    public function rules()
    {
        return [
            [['username','first_name','last_name','phone','email','status'],'safe']
        ];
    }

    public function search($params)
    {
        $query = Course::find()->active();

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
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like','science_id',$this->science_id])
            ->andFilterWhere(['like','teacher_id',$this->teacher_id])
            ->andFilterWhere(['like','room_id',$this->teacher_id])
            ->andFilterWhere(['like','price',$this->price])
            ->andFilterWhere(['capacity' => $this->capacity])
            ->andFilterWhere(['status' => $this->status]);

        return $dataProvider;
    }
}