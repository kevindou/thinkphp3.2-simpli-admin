<?php
/**
 * Class CommonAction
 * Desc: 公告控制器类
 */
class CommonAction extends Action
{
    private   $cookieName = 'servers';
    protected $session    = 'gt_homeUser';

    // 错误信息
    protected $strError = '服务器繁忙,请稍后再试...';
    protected $arrError = array(
        'status' => 0,
        'msg'    => '填写信息不完整',
    );

    // 成功信息
    protected $arrSuccess = array(
        'status' => 1,
        'msg'    => '操作成功',
    );

	// 初始化函数
	public function _initialize()
	{
        // 注入变量
        $this->assign(array(
            'arrAgents'    => M('project_agent')->where(array('id' => array('neq', '13')))->findAll(),  // 平台信息
            'pitch'        => $this->listPitch(),
            'arrRecommend' => M('project_server')->where(array('status' => 1, 'recommend' => 1))->order('sort ASC')->limit(5)->findAll(),
        ));
	}

	// TOP 列表选中高亮
	public function listPitch()
	{
		return $_GET['pitch'] ? $_GET['pitch'] : 'main';
	}

	// 验证用户有没有登录
	protected function checkLogin()
	{
		if ( ! isset($_SESSION[$this->session]) || empty($_SESSION[$this->session]) || empty($_SESSION[$this->session]['id']))
        {
			header('Location:/');
			exit;
		}
	}

    // 返回数据给AJAX
    protected function returnAjax($arrData)
    {
        if (!isset($arrData['data'])) $arrData['data'] = array();
        $this->ajaxReturn($arrData['data'], $arrData['msg'], $arrData['status']);
    }

    /**
     * wirte_log_pay() 写入支付记录
     * @access protected
     * @param  array $log 日志信息
     */
	protected function wirte_log_pay($log)
    {
		$fp = fopen ( $_SERVER ['DOCUMENT_ROOT'] . "/Lib/Log/" . $log ['file'] . "_" . date ( 'Ymd', $_SERVER ['REQUEST_TIME'] ) . '.log', "a" );
		fwrite ( $fp, $log['data'] . "\r\n" );
		fclose ( $fp );
	}

    /**
     * addCookie() 添加用户近登录的服务器信息
     * @access protected
     * @param  array $servers 服务器信息(名称和ID)
     * @param  bool  $isInset 是否新增
     */
    protected function addCookie($servers, $isInset = true)
    {
        $cookieJson = array($servers); // 默认赋值
        // 判断存在
        if (isset($_COOKIE[$this->cookieName]))
        {
            // 处理数组
            $cookieJson = json_decode($_COOKIE[$this->cookieName], true);
            // 判断是否存在
            foreach ($cookieJson as $key => $value)
            {
                // 存在删除
                if ($value['agentid'] == $servers['agentid'] && $value['id'] == $servers['id']) unset($cookieJson[$key]);
            }

            // 新增将数据存到最前面
            if ($isInset) array_unshift($cookieJson, $servers);

            // 判断是否已经超出范围(超出移除最后一个)
            if (count($cookieJson) > 5) array_pop($cookieJson);
        }

        // 重新设置COOKIE
        setcookie($this->cookieName, json_encode($cookieJson), time() + 86400 * 30);
    }

    /**
     * getCookie() 获取用户浏览历史记录
     * @access protected
     * @return array 返回获取的数组
     */
    protected function getCookie()
    {
        return isset($_COOKIE[$this->cookieName]) ? json_decode($_COOKIE[$this->cookieName], true) : array();
    }

    public function goError()
    {
        $this->assign('jumpUrl', '/');
        $this->error('您好！我们的新平台已经迁移了哦！正在为您跳转到新官网...');
    }
}
?>