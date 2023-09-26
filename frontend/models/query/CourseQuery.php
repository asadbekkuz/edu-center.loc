<?php

namespace frontend\models\query;

use frontend\models\Course;
use yii\db\ActiveQuery;

class CourseQuery extends ActiveQuery
{
    public function active()
    {
        return $this->orWhere(['status'=>Course::STATUS_INACTIVE])->orWhere(['status'=>Course::STATUS_ACTIVE]);
    }

    public function getDateTime()
    {
        return $this->select(['name','start_date','end_date'])->asArray();
    }
}