<?php
/**
 * file: IndexController.class.php
 * desc: 我的个人博客首页控制器
 * user: liujx
 * date: 2015-11-22
 */

// 引入命名空间
namespace Admin\Controller;
use Admin\Common\CommonController;
use Common\CHtml;

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class CategoryController extends CommonController
{
    public $title = '文章分类';
    public $model = 'Category';

    // 显示之前的数据处理
    public function beforeShow(&$value, $model)
    {
        $arrPids    = array();
        foreach ($value as $val) $arrPids[] = $val['pid'];
        $arrCate    = $model->field('id, cate_name')->where(array('id' => array('in', $arrPids)))->select(array('index' => 'id'));
        $arrCate[0] = array('cate_name' => '父级分类');
        foreach ($value as &$val)
        {
            $val['create_time']   = date('Y-m-d H:i:s', $val['create_time']);
            $val['str_pid']       = $arrCate[$val['pid']]['cate_name'];
            $val['str_status']    = $model->arrStatus[$val['status']];
            $val['str_recommend'] = $model->arrRecommend[$val['recommend']];
            $val['update_time']   = date('Y-m-d H:i:s', $val['update_time']);
        }
    }
}