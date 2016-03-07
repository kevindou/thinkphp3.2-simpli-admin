<?php
/**
 * file: CategoryModel.class.php
 * desc: 文章分类
 * user: liujx
 * date: 2015-11-30
 */
namespace Admin\Model;
use Admin\Common\CommonModel;
use Common\CHtml;

class CategoryModel extends CommonModel
{
    public $strLike   = 'cate_name';

    // jquery.dataTable 表格类信息
    public function showTableAttributes()
    {
        return array(
            'id'          => array('title' => '标识ID', 'search' => array('type' => 'text')),
            'pid'         => array('title' => '父类ID', 'data' => 'str_pid'),
            'cate_name'   => array('title' => '分类名称'),
            'sort'        => array('title' => '排序'),
            'recommend'   => array('title' => '推荐', 'data' => 'str_recommend', 'search' => array('type' => 'select', 'value' => $this->arrRecommend)),
            'status'      => array('title' => '状态', 'data' => 'str_status', 'search' => array('type' => 'select', 'value' => $this->arrStatus)),
            'create_time' => array('title' => '创建时间'),
            'operate'     => array('title' => '操作', 'bSortable' => false, 'defaultContent' => CHtml::aceThOperates($this->defaultOperate, $this->hideButtons))
        );
    }

    // 表单字段信息
    public function showFormAttributes()
    {
        // 查询所有一级分类
        $arrParent    = CHtml::setOption($this->field('id,cate_name')->where(array('pid' => 0))->select(), 'id', 'cate_name');
        $arrParent[0] = '父级分类';
        return array(
            'id'        => array('type' => 'hidden'),
            'pid'       => array('label' => '父类ID', 'type' => 'select', 'value' => $arrParent,'options' => array('required' => true, 'number' => true)),
            'cate_name' => array('label' => '分类名称', 'options' => array('required' => true, 'rangelength' => '[2, 12]')),
            'sort'      => array('label' => '排序', 'options' => array('required' => true, 'number' => true)),
            'recommend' => array('label' => '推荐', 'type' => 'radio', 'default' => 0, 'value' => array('不推荐', '推荐'), 'options' => array('required' => true, 'number' => true)),
            'status'    => array('label' => '状态', 'type' => 'radio', 'default' => 1, 'value' => array('停用', '启用'), 'options' => array('required' => true, 'number' => true)),
        );
    }

    // 数据验证
    protected $_validate = array(
        array('pid', 'number', '父类ID必须为一个数字', 1),
        array('cate_name', 'require', '分类名称不能为空', 1),
        array('cate_name', '/\S{2,12}/', '分类名称必须为2到12位字符串', 1),
        array('cate_name', '', '分类名称已经存在', 1, 'unique', 1),
        array('sort', 'number', '排序必须是一个数字', 1),
        array('status', 'number', '状态必须是一个数字', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'            => '分类ID',
        'str_pid'       => '父类ID',
        'path'          => '分类路径',
        'cate_name'     => '分类名称',
        'sort'          => '分类排序',
        'str_status'    => '分类状态',
        'str_recommend' => '推荐',
        'create_time'   => '创建时间',
        'create_id'     => '创建用户',
        'update_time'   => '修改时间',
        'update_id'     => '修改者ID',
    );
}