<?php

/**
 * Class GameAction
 * Desc: 平台服务器列表
 * User: liujx
 * Date: 2015-12-18
 */
class GameAction extends CommonAction
{
	// 首页显示
    public function index()
	{
        // 接收数据
        $intAid  = (int)get('aid');                      // 平台ID
        $intPid  = (int)get('pid', 1);                   // 项目ID

        // 判断数据的有效性
        $strMsg = '提交参数错误哦！';
        if ( ! empty($intAid))
        {
            $arrAgent = M('project_agent')->where(array('projectId' => $intPid, 'id' => $intAid, 'status' => 1))->find();
            $strMsg   = '抱歉！您进入的平台没有被启用或者不存在';
            if ($arrAgent)
            {
                $objModel   = M('project_server');
                $arrOrder   = array('id' => 'ASC');
                $arrWhere   = array('projectId' => $intPid, 'agentid' => $intAid, 'status' => 1);
                $arrServers = $objModel->where($arrWhere)->order($arrOrder)->select();
                $strMsg = '抱歉！该游戏平台还没有开服哦...';
                if ($arrServers)
                {
                    $arrWhere['recommend'] = 1;
                    $recommend = $objModel->where($arrWhere)->order($arrOrder)->find();

                    // 注入变量
                    $this->assign(array(
                        'title'         => $arrAgent['cn_name'].' - 服务器列表',  // 标题
                        'recommend'     => $recommend,                           // 推荐服
                        'all_server'    => $arrServers,                          // 所有服
                        'islastServer'  => $this->getCookie(),                   // 上次登录服务器信息
                    ));

                    // 加载页面
                    $this->display();
                    exit;
                }
            }
        }

        $this->assign('jumpUrl', '/');
        $this->error($strMsg);
    }

    // 查询全部服务器信息
    public function getAll()
    {
        // 定义返回数据
        $arrData = array(
            'total'  => 0,
            'result' => array(),
        );

        // 接收参数
        $intPage  = post('pageIndex');           // 第几页
        $intSize  = (int)post('pageSize');       // 每页多少条
        $intAid   = (int)post('gid');            // 服务器ID
        $intStart = $intPage * $intSize;         // 查询起始位置

        // 判断数据有效性
        if ($intAid && $intSize)
        {
            $model    = M('project_server');    // 数据库模型
            $arrWhere = array(
                'projectId' => 1,               // 游戏项目ID
                'agentid'   => $intAid          // 平台ID
            );

            // 查询数据
            $arrData['total']  = $model->where($arrWhere)->count();
            $arrData['result'] = $model->field('id AS sid,serverName AS servername')->where($arrWhere)->limit("$intStart, $intSize")->order('id ASC')->select();
        }

        // 返回数据
        exit(json_encode($arrData));
    }
}
?>