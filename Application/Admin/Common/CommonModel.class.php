<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2015/12/31
 * Time: 18:00
 */

namespace Admin\Common;
use Think\Model;

/**
 * Class JqGridModel
 * @package Admin\Common
 * desc: 使用JqGrid 方式显示数据
 */
class CommonModel extends Model
{
    // 设置默认的字段
    public    $arrStatus    = array('停用', '启用');   // 数据表中公共状态字段
    public    $arrRecommend = array('不推荐', '推荐'); // 数据表中推荐字段信息
    public    $attribute    = array();           // 字段说明信息 'id' => 'ID', 'name' => '用户名';
    public    $isNew        = true;              // 是否是新增数据
    public    $strLike      = '';                // 模糊查询字段
    protected $session      = 'my_blog_admin';   // SESSION名称

    // jqGrid
    public    $arrColModel  = array();           // 表格列的属性 ['name' => 'id',   'index' => 'id', 'width' => 60, 'sorttype'   => 'int', 'editable' => true],
    public    $arrDetail    = array();           // 详情信息列的属性 同上
    // 显示表格列的属性
    public function showColModel(){ return array();}
    public function showDetail(){ return array();}

    // jquery.dataTables
    public   $hideButtons   = array();           // 需要隐藏的表单按钮信息

    // jquery.dataTables 表格中添加操作信息
    public   $defaultOperate = array(
        'search-plus' => array('title' => '查看', 'class' => 'btn-success me-info', 'span-class' => 'blue', 'a-class' => 'me-info'),
        'pencil'      => array('title' => '编辑', 'class' => 'btn-info me-edit', 'span-class' => 'green', 'a-class' => 'me-edit'),
        'trash-o'     => array('title' => '删除', 'class' => 'btn-danger me-delete', 'span-class' => 'red', 'a-class' => 'me-delete'),
    );

    // jquery.dataTable 表格类信息
    public function showTableAttributes(){ return array();}

    // 表单字段信息
    public function showFormAttributes(){ return array();}

    // 数据新增的之前操作
    protected function _before_insert(&$data,$options)
    {
        $data['create_time'] = $data['update_time'] = time();
        $data['create_id']   = $data['update_id']   = $_SESSION[$this->session]['id'];
        return true;
    }

    // 数据修改之前操作
    protected function _before_update(&$data,$options)
    {
        $data['update_time'] = time();
        $data['update_id']   = $_SESSION[$this->session]['id'];
        return true;
    }
}