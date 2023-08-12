<?php

namespace frontend\models;

use Yii;
use common\components\db\CustomActiveRecord;
use common\models\User;
use frontend\models\query\CourseQuery;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $name
 * @property int $science_id
 * @property int $teacher_id
 * @property int $room_id
 * @property float $price
 * @property int|null $capacity
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Group[] $groups
 * @property Room $room
 * @property Science $science
 * @property Teacher $teacher
 * @property User $updatedBy
 */
class Course extends CustomActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    public static function filterDropDown()
    {
        return [
            self::STATUS_INACTIVE => 'INACTIVE',
            self::STATUS_ACTIVE => 'ACTIVE'
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'science_id', 'teacher_id', 'room_id', 'price'], 'required'],
            [['science_id', 'teacher_id', 'room_id', 'capacity', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
            [['science_id'], 'exist', 'skipOnError' => true, 'targetClass' => Science::class, 'targetAttribute' => ['science_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
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
            'science_id' => Yii::t('app', 'Science ID'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'price' => Yii::t('app', 'Price'),
            'capacity' => Yii::t('app', 'Capacity'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['course_id' => 'id']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    /**
     * Gets query for [[Science]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScience()
    {
        return $this->hasOne(Science::class, ['id' => 'science_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public static function find()
    {
        return new CourseQuery(get_called_class());
    }


}
