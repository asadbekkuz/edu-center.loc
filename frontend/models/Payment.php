<?php

namespace frontend\models;

use frontend\models\query\PaymentQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property float $price
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Course $course
 * @property Student $student
 */
class Payment extends \yii\db\ActiveRecord
{
    const PAYMENT_DEBTOR = 0;
    const PAYMENT_PAID = 1;

    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    public static function filterDropDown()
    {
        return [
            self::PAYMENT_PAID => 'PAID',
            self::PAYMENT_DEBTOR => 'DEBTOR',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id', 'price'], 'required'],
            [['student_id', 'course_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student'),
            'course_id' => Yii::t('app', 'Course'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery|CourseQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery|StudentQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentQuery(get_called_class());
    }
    
    /**
     * 
     *  Show status with badges, 
     */
    public function showStatus($status)
    {
        $badge = '<span class="badge badge-dark">UNKOWN</span>';
        if($status == '0')
        {
            $badge = '<span class="badge badge-secondary">DEBTOR</span>';
        }elseif($status == '1')
        {
            $badge = '<span class="badge badge-success">PAID</span>';
        }
        return $badge;
    }
}
