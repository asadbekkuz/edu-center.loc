<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $science_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $phone
 * @property float|null $salary
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Science $science
 * @property User $updatedBy
 * @property User $user
 */
class Employee extends \yii\db\ActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $username;

    public $password;

    public $email;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ],
            [
                'class' => BlameableBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','password','first_name','last_name','address', 'phone','salary','science_id'],'required'],
            [['username','password','email'],'string','max' => 100],
            [['user_id', 'science_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['salary'], 'number'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 45],
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
            'user_id' => Yii::t('app', 'User'),
            'science_id' => Yii::t('app', 'Science'),
            'username' => Yii::t('app', 'User Name'),
            'password' => Yii::t('app', 'Password'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'salary' => Yii::t('app', 'Salary'),
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
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreated()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Science]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getScience()
    {
        return $this->hasOne(Science::class, ['id' => 'science_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdated()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
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
    public function showStatus($status)
    {
        $badge = '<span class="badge badge-dark">UNKOWN</span>';
        if($status == '0')
        {
            $badge = '<span class="badge badge-danger">DELETED</span>';
        }elseif($status == '1')
        {
            $badge = '<span class="badge badge-success">ACTIVE</span>';
        }
        return $badge;
    }
}
