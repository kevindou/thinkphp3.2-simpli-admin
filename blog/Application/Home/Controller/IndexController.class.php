<?php
/**
 * file: IndexController.class.php
 * desc: 我的个人博客首页控制器
 * user: liujx
 * date: 2015-11-22
 */

// 引入命名空间
namespace Home\Controller;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class IndexController extends \Think\Controller
{
    public $arrMsg = array('status' => 0, 'msg'    => '提交数据为空', 'data'   => array());

    // 初始化查询数据
    public function _initialize()
    {
        // 查询图片文章信息
        $model  = M('article');
        $images = $model->field('id, title, img, create_time')->where(array('status' => array('eq', 1), 'img' => array('neq', '')))->order('create_time desc')->limit(5)->select();
        $field  = 'id, title, create_time';
        $status = array('status' => 1);
        // 查询点击排行
        $sees   = $model->field($field)->where($status)->order('see_num desc')->limit(6)->select();
        // 查询热门
        $comms  = $model->field($field)->where($status)->order('create_time desc')->limit(6)->select();
        // 查询推荐
        $recoms = $model->field($field)->where(array('status' => 1, 'recommend' => 1))->order('create_time desc')->limit(6)->select();
        // 注入变量
        $this->assign(array('timgs' => $images, 'sees'  => $sees, 'comms' => $comms, 'recoms' => $recoms));
    }

    // 首页显示
    public function index()
    {
        // 查询轮播图片信息
        $images = M('image')->field('title, desc, url')->where(array('type' => 1, 'status' => 1))->order('sort')->select();

        // 查询最新的博客使用分页
        $arrWhere = array('status' => array('eq', 1), 'img' => array('neq', ''));
        $model    = M('article');
        $intCount = $model->where($arrWhere)->count();
        $objPage  = new \Think\Page($intCount, 8);
        $objPage->lastSuffix = false;
        $objPage->rollPage   = 9;
        $strShow  = $objPage->show();
        $articles = $model->field('id, title, content, img, create_time, see_num, comment_num')->where($arrWhere)->order('create_time desc')->limit($objPage->firstRow.','.$objPage->listRows)->select();

        // 注入变量
        $this->assign(array(
            'images'   => $images,          // 轮播图片信息
            'articles' => $articles,        // 最新的文章
            'page'     => $strShow,         // 分页信息
        ));

        $this->display('index');
    }

    // 文章显示
    public function article()
    {
        // 查询最新的博客使用分页
        $arrWhere = array('status' => 1);
        $model    = M('article');
        $intCount = $model->where($arrWhere)->count();
        $objPage  = new \Think\Page($intCount, 25);
        $objPage->lastSuffix = false;
        $objPage->rollPage   = 9;
        $strShow  = $objPage->show();
        $articles = $model->field('id, title, create_time')->where($arrWhere)->order('create_time desc')->limit($objPage->firstRow.','.$objPage->listRows)->select();
        $this->assign(array(
            'articles' => $articles,
            'page'     => $strShow,
        ));
        $this->display('article');
    }

    // 文章详情显示
    public function articleView()
    {
        $id = (int)get('id');
        if ( ! empty($id))
        {
            $model   = M('article');
            $article = $model->where(array('id' => $id))->find();
            // 上下篇信息
            $prev    = $model->field('id, title')->where(array('id' => array('lt', $id)))->order('id desc')->find();
            $next    = $model->field('id, title')->where(array('id' => array('gt', $id)))->order('id asc')->find();
            $this->assign(array(
                'article' => $article,
                'prev'    => $prev,
                'next'    => $next,
            ));

            $this->display('article_view');
            exit;
        }

        $this->redirect('Index/index');
    }

    // 显示相册
    public function image()
    {
        // 查询图片信息
        $images  = M('image')->field('title, url')->where(array('status' => 1))->order('sort')->select();

        // 查询文章的图片
        if (empty($images)) $images = array();
        $articles = M('article')->where(array('img' => array('NEQ', "")))->order('see_num')->select();
        if ( ! empty($articles))
        {
            foreach ($articles as $value) array_push($images, array('title' => $value['title'], 'url' => $value['img']));
        }

        // 查看图片
        $this->assign('images', $images);
        $this->display('image');
    }


    // 用户登录
    public function login()
    {
        if (IS_AJAX && IS_POST)
        {
            // 定义数据验证规则
            $validate = array(
                array('username', 'require', '登录名不能为空', 1),
                array('username', '/\S{2,12}/', '登录名需要为2到20个字符', 1),
                array('password', 'require', '登录密码不能为空', 1),
                array('password', '/\S{2,12}/', '登录密码需要为6到16个字符', 1),
            );

            // 创建模型对象
            $model  = M('admin');
            $isTrue = $model->validate($validate)->create();
            $this->arrMsg['msg'] = $model->getError();
            if ($isTrue)
            {
                // 查询数据是否存在
                $user = $model->where(array(
                    'username' => $model->username,
                    'password' => sha1($model->password)
                ))->find();
                $this->arrMsg['msg'] = '登录账号或者密码错误!';
                if ($user)
                {
                    // 设置session
                    session('my_user', $user);
                    $this->arrMsg = array(
                        'status' => 1,
                        'msg'    => '登录成功 ^.^ !',
                        'data'   => $user['username'],
                    );
                }
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }

    // 用户退出登录
    public function logout()
    {
        if (IS_AJAX)
        {
            session('my_user', null);
            $this->arrMsg = array('status' => 1, 'msg'=> '您已经退出登录');
        }

        $this->ajaxReturn($this->arrMsg);
    }
}