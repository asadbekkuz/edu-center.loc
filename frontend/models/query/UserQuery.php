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
}