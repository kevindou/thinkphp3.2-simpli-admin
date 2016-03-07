<?php

class ServerAction extends CommonAction
{
    // 首页显示游戏
    public function index()
	{
		$this->checkLogin();

        // 接收参数
        $strUid  = $_SESSION[$this->session]['suid'];      // 用户平台号
        $intPid  = $_SESSION[$this->session]['projectid']; // 用户所属项目
        $intAid  = (int)get('aid');                        // 平台ID
        $intSid  = (int)get('server_id');                  // 服务器ID

        // 判断数据的有效性
        $strMsg = '抱歉！您进入的游戏平台信息存在错误...';
        if (!empty($intSid) && !empty($intAid))
        {
            $arrAgent = M('project_agent')->field('projectId, apiUrl, loginSecret, cn_name')->where(array('projectId' => $intPid, 'id' => $intAid, 'status' => 1))->find();
            $strMsg   = '抱歉！您进入的游戏平台不存在或者没有启用哦...';
            if ($arrAgent)
            {
                $arrServer = M('project_server')->field('id, agentid, serverName')->where(array('id' =>$intSid, 'agentid' => $intAid, 'status' => 1))->find();
                $strMsg    = '抱歉！您进入的游戏服还没有开服哦...';
                $intTime   = time();
                if (!empty($arrServer) && $arrServer['open_time'] < $intTime)
                {
                    // 请求地址
                    $strUrl = trim($arrAgent['apiUrl'], '/').'/login.php?'.http_build_query(array(
                        'uid'       => urlencode($strUid),      // 用户平台ID
                        'server_id' => $intSid,                 // 服务器ID
                        'time'      => $intTime,                // 时间戳
                        // 登录密钥
                        'sign'      => md5("uid={$strUid}&time={$intTime}&server_id={$intSid}{$arrAgent['loginSecret']}")
                    ));

                    // 记录信息
                    $this->addCookie($arrServer);
                    $arrInfo = M('project_info')->field('projectName')->where(array('id' => $intPid))->find();

                    // 注入变量加载模板
                    $this->assign(array(
                        'title' => $arrInfo['projectName'].':'.$arrAgent['cn_name'],    // 标题
                        'url'   => $strUrl,                                             // 游戏地址
                    ));
                    $this->display();
                    exit;
                }
            }
        }

        $this->assign('jumpUrl', '/');
        $this->error($strMsg);
    }
}
?>