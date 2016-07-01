<?php
/**
 * file: ImageController.class.php
 * desc: 图片管理 执行操作控制器
 * user: liujx
 * date: 2016-07-01 19:44:42
 */

// 引入命名空间
namespace Admin\Controller;

class ImageController extends Controller
{
    // model
    protected $model = 'my_image';

    // 查询方法
    public function where($params)
    {
        return [
            'orderBy' => 'id',
        ];
    }

    // 新增之前的处理
    protected function beforeInsert(&$model)
    {
        $model->update_id   = $model->create_id   = $this->user->id;
        $model->update_time = $model->create_time = time();
        return true;
    }

    // 修改之前的处理
    protected function beforeUpdate(&$model)
    {
        $model->update_id   = $this->user->id;
        $model->update_time = time();
        return true;
    }
}