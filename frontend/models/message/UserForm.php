<?php

namespace frontend\models\message;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $status;
    public $type;
    public $body;

    public function rules()
    {
        return [
            [['status','type','body'],'required'],
            ['status','integer'],
            ['type','string','max' => 100],
            ['body','string']
        ];
    }

    public function attributes()
    {
        return [
            'status' => Yii::t('app','Status'),
            'type' => Yii::t('app','Lavozim'),
            'body' => Yii::t('app','Description')
        ];
    }
}