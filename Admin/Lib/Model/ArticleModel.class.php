<?php
/**
 * file: CategoryModel.class.php
 * desc: 文章信息
 * user: liujx
 * date: 2015-11-30
 */
class ArticleModel extends CommModel
{
    public $arrEditTh = array();
    public $strLike   = 'title,content';

    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '分类ID', 'name' => 'cateId', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '标题', 'name' => 'title'),
        array('title' => 'TAG标签', 'name' => 'tags', 'search' => array('type' => 'text', 'and' => 'LIKE')),
        array('title' => '来源', 'name' => 'source', 'sort' => true),
        array('title' => '排序', 'name' => 'sort', 'sort' => true),
        array('title' => '推荐', 'name' => 'recommend', 'search' => array('type' => 'select')),
        array('title' => '状态', 'name' => 'status'),
        array('title' => '创建时间', 'name' => 'createTime', 'sort' => true),
    );

    // 添加数据
    public $arrAddTh = array(
        'cateId'    => array('label' => '分类ID', 'type' => 'select', 'other' => array('required' => true, 'number' => true)),
        'title'     => array('label' => '标题', 'other' => array('required' => true, 'rangelength' => '[2, 100]')),
        'tags'      => array('label' => 'TAG标签', '1other' => array('rangelength' => '[2, 100]')),
        'content'   => array('label' => '内容', 'type' => 'textarea', 'other' => array('required' => true, 'minlength' => '2', 'class' => 'cleditor', 'rows' => 3)),
        'source'    => array('label' => '来源', 'other' => array('rangelength' => '[2, 50]')),
        'sourceUrl' => array('label' => '来源URL', 'other' => array('url' => true)),
        'recommend' => array('label' => '是否推荐', 'type' => 'radio','checked' => 0, 'other' => array('required' => true, 'number' => true)),
        'sort'      => array('label' => '默认排序', 'value' => 1, 'other' => array('required' => true, 'number' => true)),
        'status'    => array('label' => '状态', 'type' => 'radio', 'checked' => 1, 'other' => array('required' => true, 'number' => true)),
        'id'        => array('type' => 'hidden'),
    );

    // 数据验证
    protected $_validate = array(
        array('cateId', 'number', '文章分类必须为一个数字', 1),
        array('title', 'require', '标题不能为空', 1),
        array('title', '/\S{2,100}/', '标题长度限制为2到100位', 1),
        array('tags', '/\S{0,100}/', 'TAG标签字符长度不能大于100位', 1),
        array('content', 'require', '内容不能为空', 1),
        array('content', '/\S{2,}/', '内容不能小于2位', 1),
        array('source', '/\S{2,50}/', '来源信息需要为2到50位字符', 2),
        array('sourceUrl', 'url', '来源URL格式错误', 2),
        array('sort', 'number', '排序必须是一个数字', 1),
        array('status', 'number', '状态必须是一个数字', 1),
    );

    // 详情信息
    public $attribute = array(
        'id'         => '文章ID',
        'cateId'     => '文章分类ID',
        'title'      => '文章标题',
        'tags'       => 'TAG标签',
        'content'    => '文章内容',
        'source'     => '文章来源',
        'sourceUrl'  => '来源URL',
        'sort'       => '排序',
        'recommend'  => '是否为推荐',
        'status'     => '文章状态',
        'createTime' => '创建时间',
        'createId'   => '创建用户',
        'updateTime' => '修改时间',
        'updateId'   => '修改者ID',
    );
}