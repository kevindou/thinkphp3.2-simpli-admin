<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
use Common\Auth;

class AuthController extends Controller
{
    // 定义查询数据
    public $model = 'auth_item';

    // 显示首页
    public function index()
    {
        $this->display('Admin/auth');
    }

    // 查询处理
    public function where($params)
    {
        return [
            'name'    => 'like',
            'orderBy' => 'create_time',
            'where'   => ['type' => ['eq', 2]], // 查询权限
        ];
    }

    // 修改数据
    public function update()
    {
        if (IS_AJAX)
        {
            // 接收参数
            $sType = post('actionType');                  // 操作类型
            $aType = ['delete', 'insert', 'update'];      // 可执行操作
            $iType = (int)get('type');                    // 角色和权限类型 1 角色 2 权限
            $this->arrMsg['msg'] = "操作类型错误";

            // 操作类型判断
            if (in_array($sType, $aType, true))
            {
                $this->arrMsg['msg'] = '抱歉你没有操作权限';
                if ($this->user->id === 1 || $aType !== 'delete' || Auth::can($this->user->id, 'deleteAuth'))
                {
                    // 验证用户删除的权限
                    $isTrue = Auth::handleItem($sType, Auth::AUTH_TYPE, $this->user->id);
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