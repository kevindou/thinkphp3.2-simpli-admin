<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2015/11/30
 * Time: 18:27
 */
class CommModel extends Model
{
    // 初始化定义显示信息
    public    $isNew     = true;           // 是否是新增数据
    public    $strLike   = '';             // 模糊查询字段
    public    $attribute = array();        // 详情信息
    public    $arrShowTh = array();        // 表格显示信息
    public    $arrAddTh  = array();        // 添加表单信息
    public    $arrEditTh = array();        // 修改表单信息


    protected $session     = 'gt_adminuser'; // SESSION名称

    // 根据字段处理数组(查询字段处理)
    protected function _after_select(&$resultSet,$options)
    {
        if (isset($options['index']) && ! empty($options['index']) && ! empty($resultSet))
        {
            $data  = array();
            $index = $options['index'];
            if (isset($options['keyval']) && ! empty($options['keyval']))
                foreach ($resultSet as $value) $data[$value[$index]] = $value[$options['keyval']];
            else
                foreach ($resultSet as $value) $data[$value[$index]] = $value;
            $resultSet = $data;
        }
    }

    // 数据新增的之前操作
    protected function _before_insert(&$data,$options)
    {
        $data['createTime'] = $data['updateTime'] = time();
        $data['createId']   = $data['updateId']   = $_SESSION[$this->session]['id'];
        return true;
    }

    // 数据修改之前操作
    protected function _before_update(&$data,$options)
    {
        $data['updateTime'] = time();
        $data['updateId']   = $_SESSION[$this->session]['id'];
        return true;
    }
}