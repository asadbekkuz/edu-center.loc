<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $science_id
 * @property float|null $salary
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Course[] $courses
 * @property User $createdBy
 * @property Science $science
 * @property User $updatedBy
 * @property User $user
 */
class Teacher extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }
    public function behaviors()
    {
        return [
            [
                'class' =>TimestampBehavior::class,
            ],
            [
                'class' => BlameableBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'science_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['salary'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['science_id'], 'exist', 'skipOnError' => true, 'targetClass' => Science::class, 'targetAttribute' => ['science_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Xodim'),
            'science_id' => Yii::t('app', 'Yo\'nalish'),
            'salary' => Yii::t('app', 'Maosh'),
            'status' => Yii::t('app', 'Holat'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::class, ['teacher_id' => 'id']);
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
     * Gets query for [[Science]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScience()
    {
        return $this->hasOne(Science::class, ['id' => 'science_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    /**
     *  Get status label
     * @return array
     */
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app','ACTIVE'),
            self::STATUS_DELETED => Yii::t('app','DELETED'),
            self::STATUS_INACTIVE => Yii::t('app','INACTIVE'),
        ];
    }
}
