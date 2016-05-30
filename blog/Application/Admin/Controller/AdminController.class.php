<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
class AdminController extends Controller
{
    // 定义查询数据
    public $model = 'admin';
    public $where = array(
        'search'  => 'username',
        'id'      => 'eq',
        'email'   => 'like',
        'orderBy' => 'id',
    );

    // 显示进入首页
    public function login() {$this->display('Admin/index');}

    // 新增之前的处理
    public function beforeInsert(&$model)
    {
        $model->password    = sha1($model->password);
        $model->create_time = $model->last_time = time();
        $model->last_ip     = get_client_ip();
        return true;
    }

    // 修改之前的处理
    public function beforeUpdate(&$model)
    {
        if (empty($model->password))
            unset($model->password);
        else
           $model->password = sha1($model->password);
        return true;
    }
}