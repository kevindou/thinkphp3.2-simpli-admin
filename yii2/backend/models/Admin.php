<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Admin extends \common\models\Admin
{
    public $password;
    public $repassword;
    private $_statusLabel;
    private $_roleLabel;

    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
        ];
    }

    public static function getArrayRole()
    {
        $uid  = Yii::$app->user->id;    // 用户ID
        $auth = Yii::$app->authManager; // 权限对象
        // 管理员
        $roles = $uid == 1 ? $auth->getRoles() : $auth->getRolesByUser($uid);
        return ArrayHelper::map($roles, 'name', 'description');
    }

    public function getRoleLabel()
    {

        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $roles[$this->role];
        }
        return $this->_roleLabel;
    }

    /**
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['password', 'repassword','gameids'], 'required', 'on' => ['admin-create']],
            [['gameids'], 'required', 'on' => ['admin-update']],
            [['username', 'email', 'password', 'repassword'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            // Unique
            [['username', 'email'], 'unique'],
            // Username
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            // E-mail
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            // Status
            ['role', 'in', 'range' => array_keys(self::getArrayRole())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => ['username', 'email', 'password', 'repassword', 'status', 'role','gameids'],
            'admin-update' => ['username', 'email', 'password', 'repassword', 'status', 'role','gameids']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'password' => Yii::t('app', 'Password'),
                'repassword' => Yii::t('app', 'Repassword')
            ]
        );
    }

    public function beforeValidate()
    {
        if (! empty($this->gameids))
        {
            $array = [];
            foreach ($this->gameids as $value) $array[] = (int)$value;
            $this->gameids = json_encode($array);
            return true;
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
                $this->created_id = Yii::$app->getUser()->id;
            }
            return true;
        }
        return false;
    }
      // 查询之后
    public function afterFind()
    {
        if (! empty($this->gameids)) $this->gameids = json_decode($this->gameids);
    }
    // 获取错误信息
    public function getErrorString()
    {
        $str    = '';
        $errors = $this->getErrors();
        if ( ! empty($errors))
        {
            foreach ($errors as $value)
            {
                if (is_array($value))
                    foreach ($value as $val) $str .= $val;
                else
                    $str .= $value;
            }
        }

        return $str;
    }
}
