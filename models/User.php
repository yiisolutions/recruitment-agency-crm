<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\rbac\DbManager;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $language_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Language $language
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['first_name', 'required'],
            ['first_name', 'string', 'max' => 255],

            ['last_name', 'required'],
            ['last_name', 'string', 'max' => 255],

            ['username', 'required'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique'],

            ['email', 'required'],
            ['email', 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique'],

            ['language_id', 'integer'],
            [
                'language_id',
                'exist',
                'skipOnError' => true,
                'targetClass' => Language::className(),
                'targetAttribute' => ['language_id' => 'id'],
            ],

            ['password', 'required', 'on' => 'create'],
            ['password', 'string'],

            ['role', 'required'],
            ['role', 'string'],
            ['role', 'exist', 'targetClass' => AuthItem::className(), 'targetAttribute' => 'name', 'filter' => ['type' => AuthItem::TYPE_ROLE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('now()'),
            ],
            [
                'class' => 'bedezign\yii2\audit\AuditTrailBehavior',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();

        $am = $this->getAuthManager();

        $roles = $am->getRolesByUser($this->id);
        if (!empty($roles)) {
            $this->role = reset($roles)->name;
        }
    }

    /**
     * @inheritdoc
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert && empty($this->auth_key)) {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }

        if (!empty($this->password)) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $am = $this->getAuthManager();
        $role = $am->getRole($this->role);
        $am->revokeAll($this->id);
        $am->assign($role, $this->id);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'email' => Yii::t('app', 'Email'),
            'language_id' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function __toString()
    {
        return implode(' ', [
            $this->first_name,
            $this->last_name,
        ]);
    }

    /**
     * @throws InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * Find user identity by username or email address.
     *
     * @param $username
     * @return User|ActiveRecord|null
     */
    public static function findByUsername($username)
    {
        return static::find()->andWhere(['or',
            ['email' => $username],
            ['username' => $username],
        ])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
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
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
