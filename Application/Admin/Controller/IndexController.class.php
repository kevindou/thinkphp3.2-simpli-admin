<?php
/**
 * file'=>ndexController.class.php
 * desc'=>的个人博客首页控制器
 * user'=>iujx
 * date'=>015-11-22
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
use Common\CommonController;

/**
 * Class IndexController
 * @package Home\Controller
 * desc 用户中心
 */

class IndexController extends CommonController
{
    // 默认初始化方法
    public function __construct()
    {
        parent::__construct();
        $admin = session('my_blog_admin');
        if (ACTION_NAME != 'logout' && !empty($admin) && !empty($admin['id'])) $this->redirect('Admin/index');
    }

    // 首页用户登录
    public function index()
    {
        // 关闭模板布局
        layout(false);
        $this->display('login');
    }

    // 登录处理
    public function login()
    {
        // 数据的接收
        $arrMsg = $this->error;
        if ($this->emptyPost())
        {
            // 定义数据验证规则
            $validate = array(
                array('username', 'require', '登录名不能为空', 1),
                array('username', '/\S{2,12}/', '登录名需要为2到12个字符', 1),
                array('password', 'require', '登录密码不能为空', 1),
                array('password', '/\S{2,12}/', '登录密码需要为6到16个字符', 1),
            );

            // 创建模型对象
            $model  = M('admin');
            $isTrue = $model->validate($validate)->create();
            $arrMsg['msg'] = $model->getError();
            if ($isTrue)
            {
                // 查询数据是否存在
                $admin    = $model->where(array('username' => $model->username, 'password' => sha1($model->password)))->find();
                $arrMsg['msg'] = '登录账号或者密码错误!';
                if ($admin)
                {
                    // 修改登录信息数据
                    $model->last_time = time();
                    $model->last_ip   = get_client_ip();
                    $isTrue = $model->save();
                    $arrMsg['msg'] = $this->strError;

                    // 登录成功
                    if ($isTrue)
                    {
                        // 设置session
                        session('my_blog_admin', $admin);
                        $arrMsg['status'] = 1;
                        $arrMsg['msg']    = '登录成功,正在为您跳转...';
                    }
                }
            }
        }

        $this->ajaxReturn($arrMsg);
    }

    // 管理员退出
    public function logout()
    {
        session('my_blog_admin', null); // 清除SESSION
        $this->redirect('Index/index'); // 跳转到登录页
    }
}