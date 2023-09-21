<?php

namespace frontend\models\query;

use frontend\models\Group;
use yii\db\ActiveQuery;

class GroupQuery extends ActiveQuery
{

    /**
     * Get active groups
     * @return ActiveQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => Group::GROUP_ACTIVE]);
    }

    /**
     *  Get inactive groups
     */
    public function inActive()
    {
        return $this->andWhere(['status' => Group::GROUP_INACTIVE]);
    }
}