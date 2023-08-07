<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $floor
 * @property int|null $capacity
 * @property string|null $description
 *
 * @property Course[] $courses
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['floor', 'capacity'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'floor' => Yii::t('app', 'Floor'),
            'capacity' => Yii::t('app', 'Capacity'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::class, ['room_id' => 'id']);
    }
}
