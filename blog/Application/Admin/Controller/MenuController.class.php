<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

// 引入命名空间
class MenuController extends Controller
{
    // 定义查询数据
    public $model = 'menu';
    public $where = array(
        'search'  => 'menu_name',
        'id'      => 'eq',
        'url'     => 'like',
        'status'  => 'eq',
        'orderBy' => 'id',
    );

    // 首页显示处理
    public function index()
    {
        // 查询主栏目
        $parent = M($this->model)->field('id, menu_name')->where(array('status' => 1, 'pid' => 0))->order('sort')->select(array('index' => 'id'));
        if ( ! empty($parent)) $parent = $this->map($parent, 'id', 'menu_name');
        $parent[0] = '父级分类';
        $this->assign('parents', $parent);
        parent::index();
    }
}