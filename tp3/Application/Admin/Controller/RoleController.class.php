<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
use Common\Auth;

class RoleController extends Controller
{
    // 定义查询数据
    public $model = 'auth_item';

    // 查询处理
    public function where($params)
    {
        // 默认查询
        $where = ['type' => ['eq', 1], 'name' => [['neq', 'admin']]];

        // 模糊查询
        if (isset($params['name']) && ! empty($params['name'])) $where['name'][] = ['like', '%'.$params['name'].'%'];

        // 判断管理员权限：不是管理员只能看到自己的角色
        if ($this->user->id !== 1)
        {
            $arrRoles = Auth::getUserRoles($this->user->id);
            if ($arrRoles) $where['name'][] = ['in', array_keys($arrRoles)];
        }

        return [
            'orderBy' => 'create_time',
            'where'   => $where, // 查询角色
        ];
    }

    // 首页显示
    public function index()
    {
        $this->display('Admin/role');
    }

    // 查看角色信息
    public function view()
    {
        // 查询当前角色权限
        $strName = get('name');
        if ($strName)
        {
            // 角色信息存在
            $arrRole = Auth::getRole($strName);
            if ($arrRole && $arrRole['name'] && ($this->user->id == 1 || Auth::hasRole($this->user->id, $arrRole['name'])))
            {
                // 获取用户所有权限
                $this->assign([
                    'role'      => $arrRole,                                                 // 角色信息
                    'roleItems' => Auth::getItemDesc(Auth::getRoleItems($arrRole['name'])),  // 角色自带权限
                ]);
                $this->display();
            }
        }
    }

    // 分配权限信息
    public function allocation()
    {
        // 查询当前角色权限
        $strName = get('name');
        if ($strName)
        {
            // 角色信息存在
            $arrRole = Auth::getRole($strName);
            if ($arrRole && $arrRole['name'] && ($this->user->id == 1 || Auth::hasRole($this->user->id, $arrRole['name'])))
            {
                // 获取用户所有权限
                $this->assign([
                    'role'      => $arrRole,                                                 // 角色信息
                    'roleItems' => array_keys(Auth::getRoleItems($arrRole['name'])),         // 角色自带权限
                    'powers'    => Auth::getItemDesc(Auth::getUserItems($this->user->id)),   // 用户权限
                ]);
                $this->display();
            }
        }
    }

    // 修改角色权限
    public function create()
    {
        $name      = post('name');   // 角色名称
        $desc      = post('desc');   // 角色说明
        $arrPowers = post('powers'); // 拥有权限
        if ($name && $desc)
        {
            // 判断数据存在
            $arrRoles = M('auth_item')->field(['name'])->where(['name' => $name])->find();
            if ($arrRoles && ! empty($arrRoles['name']))
            {
                Auth::updateItem($arrRoles['name'], $desc);           // 修改角色
                if (Auth::updateRoleItems($arrRoles['name'], $arrPowers))
                {
                    $this->success('成功！');
                }
            }
        }
    }

    // 修改数据
    public function update()
    {
        if (IS_AJAX)
        {
            // 接收参数
            $sType = post('actionType');                  // 操作类型
            $aType = ['delete', 'insert', 'update'];      // 可执行操作
            $this->arrMsg['msg'] = "操作类型错误";

            // 操作类型判断
            if (in_array($sType, $aType, true))
            {
                $this->arrMsg['msg'] = '抱歉你没有操作权限';
                if ($this->user->id === 1 || $aType !== 'delete' || (Auth::can($this->user->id, 'deleteRole')))
                {
                    // 验证用户删除的权限
                    $isTrue = Auth::handleItem($sType, Auth::ROLE_TYPE, $this->user->id);
                    $this->arrMsg['msg'] = '服务器繁忙, 请稍候再试...';
                    if ($isTrue === true || is_numeric($isTrue))
                    {
                        $this->arrMsg = [
                            'status' => 1,
                            'msg'    => '操作成功 ^.^',
                            'data'   => $isTrue,
                        ];
                    }
                }
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }
}