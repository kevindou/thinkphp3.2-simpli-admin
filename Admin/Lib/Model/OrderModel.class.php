<?php
/**
 * file: AgentModel.class.php
 * desc: 平台控制器
 * user: liujx
 * date: 2015-11-30
 */
class OrderModel extends CommModel
{
    // 订单状态
    public $strLike   = 'user';

    // 表头字段
    public $arrShowTh = array(
        array('title' => '标识ID', 'name' => 'id', 'sort' => true),
        array('title' => '充值用户', 'name' => 'user', 'sort' => true),
        array('title' => '游戏平台', 'name' => 'game_id' ,'sort' => true, 'search' => array('type' => 'select', 'value' => array())),
        array('title' => '游戏服务器', 'name' => 'server_id', 'sort' => true),
        array('title' => '订单编号', 'name' => 'order_id', 'sort' => true, 'search' => array('type' => 'text')),
        array('title' => '充值金额', 'name' => 'money', 'sort' => true),
        array('title' => '充值金币', 'name' => 'amount', 'sort' => true),
        array('title' => '订单状态', 'name' => 'status', 'sort' => true, 'search' => array('type' => 'select')),
        array('title' => '生成时间', 'name' => 'createtime', 'sort' => true, 'search' => array('type' => 'text', 'class' => 'datepicker', 'and' => ' >= ')),
    );
}