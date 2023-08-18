<?php

namespace common\models;

use Yii;
use frontend\models\query\UserQuery;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string|null $phone
 * @property string|null $address
 * @property string $auth_key
 * @property string $password
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string $type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const STATUS_TEACHER = 'TEACHER';
    const STATUS_ASSISTENT = 'TEACHER_ASSISTENT';
    const STATUS_ADMIN = 'ADMIN';
    const STATUS_SUPER_ADMIN = 'SUPER_ADMIN';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','email','password'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash','password', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'phone','type'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 250],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        $this->setPassword($this->password);
        return parent::beforeSave($insert);
    }
    /**
     *  Get status label
     * @return array
     */
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_DELETED => Yii::t('app','DELETED'),
            self::STATUS_INACTIVE => Yii::t('app','INACTIVE'),
            self::STATUS_ACTIVE => Yii::t('app','ACTIVE'),
        ];
    }

    /**
     * Get status with badges
     * @param $status
     * @return string
     */
    public function getStatus($status): string
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

    public function getPosition($position)
    {
        switch ($position){
            case self::STATUS_ADMIN:
                $data = "<span class='badge badge-pill badge-primary'>".self::STATUS_ADMIN."</span>";
                break;
            case self::STATUS_ASSISTENT:
                $data = '<span class="badge badge-pill badge-success">'.self::STATUS_ASSISTENT.'</span>';
                break;
            case self::STATUS_TEACHER:
                $data = '<span class="badge badge-pill badge-warning">'.self::STATUS_TEACHER.'</span>';
                break;
            case self::STATUS_SUPER_ADMIN:
                $data = '<span class="badge badge-pill badge-info">'.self::STATUS_SUPER_ADMIN.'</span>';
                break;
            default: $data = '<span class="badge badge-pill badge-danger">UNKOWN</span>';
        }
        return $data;
    }

    public static function getPositionLabel()
    {
        return [
            self::STATUS_ASSISTENT => self::STATUS_ASSISTENT,
            self::STATUS_TEACHER => self::STATUS_TEACHER,
            self::STATUS_ADMIN => self::STATUS_ADMIN,
            self::STATUS_SUPER_ADMIN => self::STATUS_SUPER_ADMIN
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->isNewRecord){
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('admin');
            $auth->assign($authorRole, $this->getId());
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
