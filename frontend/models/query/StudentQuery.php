<?php

namespace frontend\models\query;

use frontend\models\Student;
use yii\db\ActiveQuery;

class StudentQuery extends ActiveQuery
{
    /**
     *
     *  Get lid students
     */
    public function lid()
    {
        return $this->andWhere(['status' => Student::STUDENT_LID]);
    }

    /**
     *
     * Get active Students
     */
    public function active()
    {
        return $this->andWhere(['status' => Student::STUDENT_ACTIVE]);
    }
}