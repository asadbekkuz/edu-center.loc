<?php

namespace frontend\models\query;

use common\models\User;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function active()
    {
        return $this->orWhere(['status'=>User::STATUS_INACTIVE])->orWhere(['status'=>User::STATUS_ACTIVE]);
    }

    public function teacher()
    {
        return $this->select(['id',"concat(first_name,' ',last_name) as full_name"])
            ->where(['type' => User::STATUS_TEACHER])->orWhere(['type'=>User::STATUS_ASSISTENT]);
    }
}