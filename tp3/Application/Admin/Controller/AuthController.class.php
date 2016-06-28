<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
use Admin\Model\AuthModel;

class AuthController extends Controller
{
    // 定义查询数据
    public $model = 'auth_item';

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
            $this->arrMsg['msg'] = "操作类型错误";

            // 操作类型判断
            if (in_array($sType, $aType))
            {
                $isTrue = (new AuthModel())->handleItem($sType, AuthModel::AUTH_TYPE);
                $this->arrMsg['msg'] = $isTrue;
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

        $this->ajaxReturn($this->arrMsg);
    }

}