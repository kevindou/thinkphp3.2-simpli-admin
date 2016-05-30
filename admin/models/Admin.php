<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $power
 * @property string $auto_key
 * @property string $access_token
 * @property integer $status
 * @property integer $create_time
 * @property integer $last_time
 * @property string $last_ip
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'password', 'status'], 'required'],
            [['id', 'status', 'create_time', 'last_time'], 'integer'],
            [['username', 'auto_key', 'last_ip'], 'string', 'max' => 20],
            [['password', 'access_token'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 50],
            [['power'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '账号',
            'password' => '密码(使用sha1()加密)',
            'email' => '管理员邮箱',
            'power' => '权限',
            'auto_key' => '自动登录的KEY',
            'access_token' => '自动登录TOKEN',
            'status' => '管理员状态',
            'create_time' => '注册时间',
            'last_time' => '最后登录的时间',
            'last_ip' => '最后登录IP',
        ];
    }
}
