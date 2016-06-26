<?php
/**
 * file: ArticleController
 * desc: 文章管理页面
 * user: liujx
 * date: 2016-3-16
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
use Think\Exception;

class ArticleController extends Controller
{
    // 定义查询数据
    public $model = 'article';
    public $file  = "fileimg";
    public $where = array(
        'search'    => 'title',
        'id'        => 'eq',
        'recommend' => 'eq',
        'status'    => 'eq',
        'orderBy'   => 'create_time',
    );

    // 图片处理函数
    protected function handleImage($path)
    {
        try {
            $image = new \Think\Image();
            $image->open($path);
            $image->thumb(245, 200, \Think\Image::IMAGE_THUMB_FILLED)->save($path);
            return true;
        } catch(Exception $e) {
            $this->arrMsg['msg'] = $e->getMessage();
            return false;
        }
    }
}