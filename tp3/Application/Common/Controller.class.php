<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2016/3/15
 * Time: 17:20
 */
namespace Common;

class Controller extends \Think\Controller
{
    // 定义ajaxReturn 返回的数据
    public $arrMsg = array(
        'status' => 0,              // 状态 1 成功 2 失败
        'msg'    => '提交数据为空',   // 提示信息
        'data'   => array(),        // 返回数据
    );

    // 定义session 的名称
    protected $_admin = 'my_admin';
    public    $user   = [];

    // 用户登录验证
    public function isLogin()
    {
        return isset($_SESSION[$this->_admin]) && !empty($_SESSION[$this->_admin]);
    }

    // 初始化验证用户登录
    public function _initialize()
    {
        // 判断是否已经登录
        if (!$this->isLogin()) {
            if (IS_AJAX) {
                $this->arrMsg['msg'] = '请先登录...';
                $this->ajaxReturn($this->arrMsg);
            } else {
                $this->redirect('Index/index');
            }
        }

        // 将用户信息转换为对象
        $this->user = (object)['id' => (int)$_SESSION[$this->_admin]['id'], 'name' => $_SESSION[$this->_admin]['username']];
    }

    // 删除图片
    protected function deleteImage($file)
    {
        if (!empty($file))
        {
            // 判读图片的信息
            if (strrops($file, '://mylx-') == false)
            {
                if (file_exists('.'.$file)) @unlink('.'.$file);
            }
        }
    }

    // 图片上传
    public function fileUpload()
    {
        // 判断数据上传
        if (IS_POST)
        {
            $strOld = get('fileurl');
            $upload = new \Think\Upload();                          // 实例化上传类
            $upload->maxSize  = 1024 * 1024 * 2;                    // 上传文件大小
            $upload->rootPath = './public/';                        // 图片保存绝对路径
            $upload->autoSub  = true;
            $upload->exts     = array('jpg', 'gif', 'png', 'jpeg'); // 上传文件类型
            $upload->autoSub  = true;
            $upload->subName  = array('date','Ymd');                // 文件上传的子目录
            $info = $upload->upload();
            $this->arrMsg['msg'] = $upload->getError();

            // 上传成功
            if ($info)
            {
                // 获取上传图片信息
                $info = $info[$this->file];
                if ( ! isset($info['url']) || empty($info['url'])) $info['url'] = '/Public/'.$info['savepath'].$info['savename'];

                // 删除之前的图片
                $this->deleteImage($strOld);
                $this->arrMsg = array(
                    'status' => 1,
                    'msg'    => '上传成功',
                    'data'   => $info['url'],
                );
            }
        }
        // 获取上传的Url
        $this->ajaxReturn($this->arrMsg);
    }

    /**
     * map() 生成键值对数组
     * @param array  $array 需要处理的数组
     * @param string $key   生成数组的键
     * @param string $value 生成数组的值
     * @return array 返回处理好的数组
     */
    protected function map($array, $key, $value)
    {
        $arrNew = array();
        if ( ! empty($array) && is_array($array)) foreach ($array as $arr) $arrNew[$arr[$key]] = $arr[$value];
        return $arrNew;
    }

    /**
     * success() 成功函数
     * @access protected
     * @param  string  $msg  成功提示语句
     * @param  mixed   $data 成功返回数据
     * @return void
     */
    protected function s($msg, $data){$this->arrMsg = array('status' => 1, 'msg' => $msg, 'data' => $data);}

    /**
     * emptyPost() 判断提交的post数据是否
     */
    protected function emptyPost(){return ! isset($_POST) || empty($_POST);}
}