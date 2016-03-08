<?php
/**
 * Class IndexAction
 * Desc: 后台用户登录页面
 * User: liujx
 * Date: 2015-11-30
 */
class IndexAction extends Action
{
    protected $session = 'gt_adminuser';

    // 用户登录
    public function index()
    {
        if (isset($_SESSION[$this->session]))
            $this->display('index');
        else
            $this->display('login');
    }

    // 用户执行登录
    public function login()
    {
        if (isset($_SESSION[$this->session]))
        {
            echo json_encode(array(
                'status' => 1,
            ));
            exit;
        }

        // 判断是否存在数据
        $username = $_POST['username'];   // 账号
        $password = $_POST['password'];   // 密码

        // 判断数据不为空进行登录验证
        if ($username && $password)
        {
            $admin    = D('Admin');
            $password = sha1($password);
            $message  = array(
                'status' => 0,
                'msg'    => '用户名或者密码错误！',
            );

            $where = "`username`='{$username}' AND `password`='{$password}'";
            // 开始查询数据
            $adminUser = $admin->where($where)->find();
            if ($adminUser)
            {
                // 生成用户登录信息
                $_SESSION[$this->session] = $adminUser;

                // 执行修改数据
                $message['status'] = 1;
                $message['msg']    = "登录成长,正在为您跳转到后台首页,请稍候...";
            }

            echo json_encode($message);
            exit;
        }

        // 到登录页面
        $this->display('login');
    }

    // 用户退出
    public function logout()
    {
        // 清楚SESSION
        M('Admin')->where('`id`='.$_SESSION[$this->session]['id'])->save(array(
            'lastTime' => time(),
            'lastIp'   => $_SERVER["REMOTE_ADDR"],
        ));

        unset($_SESSION[$this->session]);
        $this->display('login');
    }
}
?>