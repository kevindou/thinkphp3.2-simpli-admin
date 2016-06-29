<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
class RoleController extends Controller
{
    // 定义查询数据
    public $model = 'auth_item';

    // 查询处理
    public function where($params)
    {
        return [
            'name'    => 'like',
            'orderBy' => 'create_time',
            'where'   => ['type' => ['eq', 1]], // 查询角色
        ];
    }

    // 首页显示
    public function index()
    {
        $this->display('Admin/role');
    }

    // 分配权限信息
    public function allocation()
    {
        $this->display();
    }

}