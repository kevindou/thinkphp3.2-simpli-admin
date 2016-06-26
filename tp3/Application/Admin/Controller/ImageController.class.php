<?php
/**
 * file: ArticleController
 * desc: 图片管理页面
 * user: liujx
 * date: 2016-3-16
 */
// 引入命名空间
namespace Admin\Controller;

class ImageController extends Controller
{
    // 定义查询数据
    public $model = 'image';
    public $file  = "fileurl";
    public $where = array(
        'search'    => 'title',
        'id'        => 'eq',
        'status'    => 'eq',
        'orderBy'   => 'create_time',
    );

    // 查看图片信息
    public function view()
    {
        // 查询图片信息
        $images  = M('image')->where(array('status' => 1))->order('sort')->select();

        // 查询文章的图片
        if (empty($images)) $images = array();
        $articles = M('article')->where(array('img' => array('NEQ', "")))->order('see_num')->select();
        if ( ! empty($articles))
        {
            foreach ($articles as $value) array_push($images, array('title' => $value['title'], 'url' => $value['img']));
        }

        // 查看图片
        $this->assign('images', $images);
        $this->display('Admin/image_view');
    }
}