<?php

namespace app\modules\admin\models;

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
class Admin extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    // 设置应用场景
    public function scenarios()
    {
        return [
            'login'    => ['username', 'password'],
            'register' => ['username', 'email', 'password'],
            'default'  => ['last_time', 'last_ip'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // 登录验证
            [['username', 'password'], 'trim'],
            [['username', 'password'], 'safe'],
            [['username', 'password'], 'required', 'on' => 'login'],
            ['username', 'string', 'length' => [2, 12], 'on' => 'login'],
            ['password', 'string', 'length' => [6, 16], 'on' => 'login'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'username'      => '账号',
            'password'      => '密码',
            'email'         => '管理员邮箱',
            'power'         => '权限',
            'auto_key'      => '自动登录的KEY',
            'access_token'  => '自动登录TOKEN',
            'status'        => '管理员状态',
            'create_time'   => '注册时间',
            'last_time'     => '最后登录的时间',
            'last_ip'       => '最后登录IP',
        ];
    }

    // 显示表格信息
    public function showColModel()
    {
        return array(
            'id'          => array('width' => 60,  'editable' => false),
            'username'    => array('width' => 60, 'editrules'   => array('required' => true), 'editoptions' => array('required' => true, 'rangelength' =>'[2,12]')),
            'password'    => array('hidden' => true, 'editable' => true, 'edittype' => 'password',
                'editoptions' => array('required' => true, 'rangelength' =>'[6,12]'),
                'editrules'   => array('required' => true, 'edithidden' => true)
            ),
            'email'       => array('width' => 80,
                'editoptions' => array('reqired' => true, 'rangelength' => '[6, 25]'),
                'editrules' => array('required' => true, 'email' => true),
            ),
            'status'      => array('width' => 80, 'edittype' => 'select',
                'editoptions' => array('value'  => '0:停用;1:待审核;2:启用'),
                'editrules'   => array('number' => true, 'required' => true),
            ),
            'last_time'   => ['width' => 120, 'editable' => false, 'formatter' => 'date', 'formatoptions' => ['srcformat' => 'u', 'newformat' => 'Y-m-d H:i:s']],
            'last_ip'     => array('width' => 80,  'editable' => false),
            'create_time' => array('editable' => false, 'formatter' => 'date', 'formatoptions' => ['srcformat' => 'u', 'newformat' => 'Y-m-d H:i:s']),
        );
    }
}
