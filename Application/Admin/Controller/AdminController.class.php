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

/**
 * Class IndexController
 * @package Home\Controller
 * desc: 首页控制器
 */

class AdminController extends CommonController
{
    // 初始化定义
    public $title      = '管理员';
    public $model      = 'Admin';
    public $strShowWay = 'jqGrid';

    // 显示之前的数据处理
    public function beforeShow(&$value, $model)
    {
        $arrStatus = array('待审核', '审核完成', '停用');
        foreach ($value as &$val)
        {
            $val['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
            $val['last_time']   = date('Y-m-d H:i:s', $val['last_time']);
            $val['status']      = $arrStatus[$val['status']];
        }
    }
}