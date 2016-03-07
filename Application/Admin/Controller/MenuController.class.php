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

class MenuController extends CommonController
{
    public $title = '导航栏';
    public $model = 'Menu';

    // 显示之前的数据处理
    public function beforeShow(&$value, $model)
    {
        $arrPids    = array();
        foreach ($value as $val) $arrPids[] = $val['parent_id'];
        $arrCate    = $model->field('id, menu_name')->where(array('id' => array('in', $arrPids)))->select(array('index' => 'id'));
        $arrCate[0] = array('menu_name' => '上级导航');
        foreach ($value as &$val)
        {
            $val['str_pid']     = $arrCate[$val['parent_id']]['menu_name'];
            $val['str_status']  = $model->arrStatus[$val['status']];
            $arrIcons           = explode('-', $val['icons']);
            $val['str_icons']   = "<i class=\"menu-icon {$arrIcons[0]} {$val['icons']}\"></i>";
            $val['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
            $val['update_time'] = date('Y-m-d H:i:s', $val['update_time']);
        }
    }
}