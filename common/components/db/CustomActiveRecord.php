<?php

namespace common\components\db;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class CustomActiveRecord extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_DELETED => Yii::t('app','DELETED'),
            self::STATUS_INACTIVE => Yii::t('app','INACTIVE'),
            self::STATUS_ACTIVE => Yii::t('app','ACTIVE'),
        ];
    }

    public function showStatus($status)
    {
        $badge = '<span class="badge badge-dark">UNKOWN</span>';
        if($status == '0')
        {
            $badge = '<span class="badge badge-danger">DELETED</span>';
        }elseif($status == '9')
        {
            $badge = '<span class="badge badge-secondary">INACTIVE</span>';
        }elseif($status == '10')
        {
            $badge = '<span class="badge badge-success">ACTIVE</span>';
        }
        return $badge;
    }

}