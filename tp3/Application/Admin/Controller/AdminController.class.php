<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

use Admin\Model\AuthModel;

// 引入命名空间
class AdminController extends Controller
{
    // 定义查询数据
    public $model = 'admin';
    public function where($params)
    {
        return [
            'id'      => 'eq',
            'email'   => 'like',
            'orderBy' => 'id',
        ];

    }

    // 显示进入首页
    public function login() {$this->display('Admin/index');}

    // 首页显示
    public function index()
    {
        // 获取用户的角色信息
        $this->assign('roles', AuthModel::getUserRoles($this->user->id));
        $this->display('Admin/admin');
    }

    // 新增之前的处理
    public function beforeInsert(&$model)
    {
        $model->roles       = implode(',', $_POST['roles']);
        $model->password    = sha1($model->password);
        $model->create_time = $model->update_time = $model->last_time = time();
        $model->create_id   = $model->update_id   = $this->user->id;
        $model->last_ip     = get_client_ip();
        return true;
    }

    // 修改之前的处理
    public function beforeUpdate(&$model)
    {
        $model->roles = implode(',', $_POST['roles']);
        if (empty($model->password))
            unset($model->password);
        else
           $model->password = sha1($model->password);
        return true;
    }
}