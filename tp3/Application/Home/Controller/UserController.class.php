<?php
/**
 * file: IndexController.class.php
 * desc: 我的个人博客用户可以操作页面
 * user: liujx
 * date: 2016-03-17
 */

// 引入命名空间
namespace Home\Controller;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class UserController extends \Common\Controller
{
    public $_admin = 'my_user';

    // 新增文章信息
    public function insert()
    {
        if (IS_AJAX && ! $this->emptyPost())
        {
            // 定义验证数据
            $validate = array(
                array('title', 'require', '文章标题不能为空', 1),
                array('title', '/\S{2,50}/', '文章标题需要为2到50个字符', 1),
                array('content', 'require', '文章内容不能为空', 1),
                array('content', '/\S{2,200}/', '文章内容需要为2到200个字符', 1),
            );

            $model  = M('article');
            $isTrue = $model->validate($validate)->create();
            $this->arrMsg['msg'] = $model->getError();
            if ($isTrue)
            {
                // 执行新增数据
                $data = $_POST;
                $data['img']        = $model->img;
                $data['see_num']    = $data['comment_num'] = 0;
                $model->create_time = $model->update_time  = $data['create_time'] = time();
                $model->create_id   = $model->update_id    = $_SESSION[$this->_admin]['id'];
                $isTrue = $model->add();
                $this->arrMsg['msg'] = '服务器繁忙, 请稍候再试...';
                if ($isTrue) $this->s('新增文章成功 ^.^ !', $data);
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }

    // 上传图片
    public function addImg()
    {
        if (IS_AJAX && ! $this->emptyPost())
        {
            // 定义验证数据
            $validate = array(
                array('title', 'require', '图片标题不能为空', 1),
                array('title', '/\S{2,50}/', '图片标题需要为2到50个字符', 1),
                array('desc', '/\S{2,200}/', '图片说明需要为2到200个字符', 1),
                array('url', 'require', '图片地址不能为空', 1),
                array('url', '/\S{2,100}/', '图片地址需要为2到100个字符', 1),
            );

            $model  = M('image');
            $isTrue = $model->validate($validate)->create();
            $this->arrMsg['msg'] = $model->getError();
            if ($isTrue)
            {
                // 执行新增数据
                $data = $_POST;
                $model->status      = 1;
                $model->create_time = $model->update_time  = time();
                $model->create_id   = $model->update_id    = $_SESSION[$this->_admin]['id'];
                $isTrue = $model->add();
                $this->arrMsg['msg'] = '服务器繁忙, 请稍候再试...';
                if ($isTrue) $this->s('上传图片成功 ^.^ !', $data);
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }
}