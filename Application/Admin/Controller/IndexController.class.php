<?php
/**
 * file'=>ndexController.class.php
 * desc'=>的个人博客首页控制器
 * user'=>iujx
 * date'=>015-11-22
 */

// 引入命名空间
namespace Admin\Controller;
use Think\Controller;

// 引入命名空间
class IndexController extends Controller 
{
    // 显示登录页面
    public function index()
    {
        // 判断是否已经登录 跳转到首页
        if ($this->isLogin()) $this->redirect('Admin/login');

        // 显示页面
        layout(false);
        $this->display("Layout/login");
    }

    // 开始登录
    public function login()
    {
        // 定义错误信息
        $arr = [
            "status" => 0,
            "msg"    => '提交参数为空',
            "data"   => null,
        ];

        // 如果已经登录
        if ($this->isLogin())
        {
            if (!IS_AJAX) $this->redirect('Admin/login');
            $arr['status'] = 1;
            $arr['msg']    = '已经登录,正在为您跳转...';
        }
        else
        {
            // 判断是否有数据提交
            if (isset($_POST) && ! empty($_POST))
            {
                // 定义数据验证规则
                $validate = [
                    ['username', 'require', '登录名不能为空', 1],
                    ['username', '/\S{2,12}/', '登录名需要为2到12个字符', 1],
                    ['password', 'require', '登录密码不能为空', 1],
                    ['password', '/\S{2,12}/', '登录密码需要为6到16个字符', 1],
                ];

                // 创建模型对象
                $model  = M('admin');
                $isTrue = $model->validate($validate)->create();
                $arr['msg'] = $model->getError();
                if ($isTrue)
                {
                    // 查询数据是否存在
                    $admin    = $model->where([
                        'username' => $model->username,
                        'password' => sha1($model->password)
                    ])->find();
                    $arr['msg'] = '登录账号或者密码错误!';
                    if ($admin)
                    {
                        // 设置session
                        session('my_admin', $admin);
                        $arr['status'] = 1;
                        $arr['msg']    = '登录成功,正在为您跳转...';
                    }
                }
            }
        }

        $this->ajaxReturn($arr);
    }

    // 退出登录
    public function logout()
    {
        // 查询用户数据
        if ($this->isLogin())
        {
            M('admin')->where(['id' => (int)$_SESSION['my_admin']['id']])->save([
                'last_time' => time(),
                'last_ip'   => get_client_ip(),
            ]);
        }

        // 清楚数据
        unset($_SESSION['my_admin']);
        $this->redirect('Index/index'); // 跳转到登录页
    }

    // 验证登录
    private function isLogin()
    {
        return isset($_SESSION['my_admin']) && ! empty($_SESSION['my_admin']);
    }
}