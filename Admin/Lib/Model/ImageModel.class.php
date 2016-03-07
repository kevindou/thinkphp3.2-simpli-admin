<?php
/**
 * file: AgentModel.class.php
 * desc: 平台控制器
 * user: liujx
 * date: 2015-11-30
 */
class ImageModel extends CommModel
{
    public $strLike = 'title,desc'; // LIKE查询字段
    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '图片标题', 'name' => 'title'),
        array('title' => '图片描述', 'name' => 'desc', 'sort' => true),
        array('title' => '图片类型', 'name' => 'type', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '图片地址', 'name' => 'url', 'sort' => true),
        array('title' => '链接地址', 'name' => 'href', 'sort' => true),
        array('title' => '状态', 'name' => 'status', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '推荐', 'name' => 'recommend', 'sort' => true, 'search' => array('type' => 'select')),
    );

    // 添加数据
    public $arrAddTh = array(
        'title'     => array('label' => '图片标题', 'other' => array('required' => true, 'rangelength' => '[2, 50]')),
        'desc'      => array('label' => '图片描述', 'other' => array('rangelength' => '[2, 100]')),
        'type'      => array('label' => '图片类型', 'type' => 'select', 'other' => array('required' => true, 'number' => true)),
        'url'       => array('label' => '上传图片', 'type' => 'file', 'other' => array('class' => 'input-file uniform_on fileUpload')),
        'href'      => array('label' => '链接地址', 'other' => array('url' => true)),
        'recommend' => array('label' => '推荐', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
        'status'    => array('label' => '状态', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
    );

    // 数据验证
    protected $_validate = array(
        array('title', 'require', '图片标题不能为空', 1),
        array('title', '/\S{2,50}/', '图片标题需要2到50位字符', 1),
        array('desc', '/\S{2,50}/', '图片描述需要2到50位字符', 2),
        array('type', 'require', '图片类型不能为空', 1),
        array('url', 'require', '请上传图片', 1),
        array('href', 'url', '链接地址格式错误', 2),
        array('recommend', 'number', '推荐需要为一个数字', 1),
        array('status', 'number', '状态需要为一个数字', 1),
    );

    // 显示详情信息
    public $attribute = array(
        'id'         => '图片ID',
        'title'      => '图片标题',
        'desc'       => '图片描述',
        'type'       => '图片类型',
        'url'        => '图片地址',
        'href'       => '图片的超链接地址',
        'status'     => '图片状态',
        'recommend'  => '推荐',
        'createTime' => '图片上传时间',
        'createId'   => '创建者',
        'updateTime' => '修改时间',
        'updateId'   => '修改者',
    );
}