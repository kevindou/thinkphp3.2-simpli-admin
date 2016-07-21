<?php
/**
 * file: AuthorityController.php
 * desc: 权限信息 执行操作控制器
 * user: liujx
 * date: 2016-07-21 13:29:28
 */

// 引入命名空间
namespace backend\controllers;

use backend\models\Auth;

class AuthorityController extends Controller
{
    // 查询方法
    public function where($params)
    {
        return [
            'name'        => 'like',
			'description' => 'like',
            'where'       => [['=', 'type', Auth::TYPE_PERMISSION]],
        ];
    }

    // 返回 Modal
    public function getModel(){return new Auth();}
}
