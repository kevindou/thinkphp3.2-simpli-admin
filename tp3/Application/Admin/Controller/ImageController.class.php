<?php
/**
 * file: ImageController.class.php
 * desc: 图片管理 执行操作控制器
 * user: liujx
 * date: 2016-07-02 17:59:02
 */

// 引入命名空间
namespace Admin\Controller;

class ImageController extends Controller
{
    // model
    protected $model = 'image';

    // 查询方法
    public function where($params)
    {
        return [
            'id'      => 'eq',
			'title'   => 'like',
			'type'    => 'eq',
			'status'  => 'eq',
            'orderBy' => 'id',
        ];
    }
}