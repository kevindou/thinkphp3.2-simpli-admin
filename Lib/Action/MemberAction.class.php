<?php

/**
 * Class MemberAction
 * Desc: 用户中心控制器
 * User: liujx
 * Date：2015-12-25
 */
class MemberAction extends CommonAction
{
    // 数据的验证
    protected $validate = array(
        // 必须验证
        array('verify', 'require', '验证码不能为空', 1, '', 3),
        array('verify', '/\d{5}/', '验证码长度为5位', 1, '', 3),
        array('agentid', 'require', '游戏平台不能为空', 1, '', 3),
        array('agentid', 'number', '游戏平台需要为数字', 1, '', 3),
        array('username', 'require', '用户名不能为空', 1, 'regex', 3),
        array('username', '/\w{2,25}/', '用户名不能小于2位或者大于25位', 1, 'regex', 3),
        array('password', 'require', '密码不能为空', 1, 'regex', 3),
        array('password', '/\w{2,25}/', '密码不能小于2位或者大于25位', 1, 'regex', 3),
    );

    // 验证密码
    protected $arrValidate = array(
        array('truepass', '/\w{5,20}/', '确认密码不能小于4位或者大于20位', 1, 'regex', 1),
        array('password', 'truepass', '确认密码和密码输入不一致', 1, 'confirm', 1),
    );

    // 用户首页
    public function index()
    {
        $this->checkLogin();

        // 查询用户信息
        $objModel   = M('project_agent');
        $agent      = $objModel->field('cn_name')->where(array('id' => $_SESSION[$this->session]['agentid']))->find();

        // 查询用户积分信息
        $model      = M('project_users');
        $arrAccount = $model->field('account')->where(array('id' => $_SESSION[$this->session]['id']))->find();
        $intAccount = $arrAccount ? $arrAccount['account'] : 0;

        // 注入变量和加载模板
        $this->assign(array(
            'account'   => $intAccount,         // 用户积分
            'agentName' => $agent['cn_name'],   // 平台信息
            'lastServs' => $this->getCookie(),  // 最近登录平台信息
        ));
        $this->display('index');
    }

	// 用户登录
	public function userLogin()
	{
		// 初始化定义数据
        $arrError = $this->arrError;
        // 数据的验证
        if (isset($_POST) && ! empty($_POST))
        {
            // 数据验证
            $model = D('project_users');
            $model->setProperty('_validate', $this->validate);
            $isTrue = $model->create();
            $arrError['msg'] = $model->getError();

            // 验证成功
            if ($isTrue)
            {
                $arrError['msg'] = '验证码错误哦...';
                if ($_SESSION['verify'] == md5(post('verify')))
                {
                    // 查询用户信息
                    $password = md5($model->password);
                    $arrUser  = $model->where(array(
                        'projectId' => 1,
                        'agentid'   => $model->agentid,
                        'username'  => $model->username,
                    ))->find();
                    $arrError['msg'] = '用户名或者游戏平台错误！';
                    if ($arrUser)
                    {
                        $arrError['msg'] = '登录密码错误！';
                        if ($arrUser['encrypt'] == $password)
                        {
                            $arrError['msg'] = '抱歉！您被管理员给封号了...';
                            if ($arrUser['status'] == 1)
                            {
                                cookie('user', $arrUser['username'], 86400);
                                $this->setSession($arrUser);

                                // 定义返回数据
                                $arrError = $this->arrSuccess;
                                $arrError['data'] = $arrUser;
                            }
                        }
                    }
                }
            }
        }

        $this->returnAjax($arrError);
    }
	
	
	// 用户注册
	public function userRegiest()
	{
        // 注册验证
        $validate = array_merge($this->validate, $this->arrValidate);
        $validate = array_merge($validate, array(
            array('username', '', '用户名已经存在', 0, 'unique', 1),
        ));

        // 验证数据的有效性
        $arrError = $this->arrError;
        if (isset($_POST) && ! empty($_POST))
        {
            // 数据验证
            $model = D('project_users');
            $model->setProperty('_validate', $validate);
            $isTrue = $model->create();
            $arrError['msg'] = $model->getError();

            // 验证成功
            if ($isTrue) {
                // 验证验证码数据
                $arrError['msg'] = '验证码错误';
                if ($_SESSION['verify'] == md5(post('verify')))
                {
                    $arrError['msg'] = '用户名已经存在';
                    $isTrue = $model->field('id')->where("`username`='{$model->username}'")->find();
                    if (empty($isTrue))
                    {
                        // 初始化数据
                        $userName          = $model->username;
                        $model->projectid  = $model->status = 1;
                        $model->createTime = $model->lastTime = time();
                        $model->lastIp     = get_client_ip();
                        $model->suid       = 'gt_' . date('Ymd') . '_' . $model->username;
                        $model->encrypt    = md5($model->password);
                        $arrError['msg']   = $this->strError;
                        $isTrue            = $model->add();

                        if ($isTrue)
                        {
                            cookie('user', $userName, 86400);
                            $this->setSession($model->find($isTrue));
                            $arrError = $this->arrSuccess;
                            $arrError['msg'] = '注册成功,欢迎来到死神WEB平台...';
                        }
                    }
                }
            }
        }

        $this->returnAjax($arrError);
	}

	// 用户信息
	public function memberInfo()
	{
		$this->checkLogin();
		$this->display('editpass');
	}

	// 修改用户登录密码
	public function editPass()
	{
		$this->checkLogin();

        // 注册验证
        $validate = array_merge($this->validate, $this->arrValidate);
        $validate = array_merge($validate, array(array('oldpass', 'require', '旧密码不能为空', 1)));

        // 验证数据的有效性
        $arrError = $this->arrError;
        if (isset($_POST) && ! empty($_POST))
        {
            // 接收参数
            $strOldPass       = post('oldpass');
            $_POST['agentid'] = $_SESSION[$this->session]['agentid'];

            // 数据验证
            $model = D('project_users');
            $model->setProperty('_validate', $validate);
            $isTrue = $model->create();
            $arrError['msg'] = $model->getError();
            $strNewPass = $model->password;

            // 判断错误信息
            if ($isTrue)
            {
                $arrError['msg'] = '没有对密码进行修改';
                if ($model->password != $strOldPass)
                {
                    $arrError['msg'] = '验证码错误';
                    if ($_SESSION['verify'] == md5(post('verify')))
                    {
                        // 查询用户名是否已经存在
                        $arrUser = $model->field('id')->where(array('username' => $model->username))->find();
                        $arrError['msg'] = '用户名已经存在';
                        if (empty($arrUser) || $arrUser['id'] == $_SESSION[$this->session]['id'])
                        {
                            // 查询条件
                            $where = array(
                                'id'       => $_SESSION[$this->session]['id'],
                                'username' => $_SESSION[$this->session]['username'],
                                'password' => $strOldPass,
                                'encrypt'  => md5($strOldPass),
                            );

                            // 修改数据
                            $model->password   = $strNewPass;
                            $model->encrypt    = md5($model->password);
                            $model->updateTime = time();
                            $model->updateId   = 0;
                            $arrError['msg']   = $this->strError;
                            if ($model->where($where)->save())  $arrError = $this->arrSuccess;
                        }
                    }
                }
            }
        }

        // 返回数据
        $this->returnAjax($arrError);
	}

	// 用户支付记录
	public function memberPay()
	{
		$this->checkLogin();

		// 接收参数
		$user_id   = (int)$_SESSION[$this->session]['id'];  // 用户唯一ID
        $intGid    = (int)post('game_id');                  // 平台ID
        $intStatus = (int)post('status');                   // 状态
        $intMoney  = (int)post('money');                    // 金额
        $intOid    = post('order_id');                      // 订单号

		import("ORG.Util.Page");
		$model = M("project_order");

        // 查询条件累加
		$where = array('user_id' => $user_id);
        if ($intGid)
        {
            $intGid = $intGid == -1 ? 0 : $intGid;
            $where['game_id']  = $intGid;
        }
        if ($intStatus)
        {
            $intStatus = $intStatus == -1 ? 0 : $intStatus;
            $where['status'] = $intStatus;
        }
        if ($intMoney)        $where['money']    = $intMoney;
        if ($intOid)          $where['order_id'] = $intOid;

        // 分页信息
		$count = $model->where($where)->count();
		$page  = new Page($count,15);

        // 分页配置信息
        $page->config = array(
            'header' => '条记录',
            'prev'   => '上一页',
            'next'   => '下一页',
            'first'  => '首页',
            'last'   => '尾页',
            'theme'  => '%first% %upPage% %linkPage% %prePage% %downPage% %end% %nextPage% %totalRow% %header% %nowPage%/%totalPage% 页',
        );

        // 查询数据信息
		$show  = $page->show();
        $limit = $page->firstRow.','.$page->listRows;
		$orderList = $model->where($where)->order('createtime DESC')->limit($limit)->select();

		// 数据存在
		if (!empty($orderList))
		{
			$Project_agent = M('project_agent');
			$agent = $Project_agent->select();
			
			foreach($orderList as $key => $val)
			{
				foreach($agent as $key2 => $val2)
				{
					if($val['game_id'] == $val2['id']) $orderList[$key]['game_id'] = $val2['cn_name'];
				}
			}
		}

		// 注入变量
		$this->assign(array(
			'orderList' => $orderList,
			'page'		=> $show,
            'status'    => array('未支付', '支付成功', '交易成功'),     // 订单状态
		));

		// 载入模板
		$this->display('paylogs');
	}


    // 删除登录历史
    public function delCookie()
    {
        $this->checkLogin();

        // 接收参数
        $intSid  = (int)get('id');      // 服务器ID
        $intAid  = (int)get('agentid'); // 平台ID
        $strName = get('name');         // 服务器信息

        // 定义错误
        $arrError = $this->arrError;
        if ($intSid && $intAid && $strName)
        {
            // 删除COOKIE
            $this->addCookie(array(
                'id'      => $intSid,
                'agentid' => $intAid,
            ), false);

            $arrError = $this->arrSuccess;
        }

        $this->returnAjax($arrError);
    }
	
	// 用户注销
	public function logout()
	{
        // 修改登录数据
        M('project_users')->where(array('id' => $_SESSION[$this->session]['id']))->save(array(
            'lastTime' => time(),
            'lastIp'   => get_client_ip(),
        ));

        // 清除数据信息
        cookie('user', null);
		unset($_SESSION[$this->session]);
        $this->returnAjax($this->arrSuccess);
	}

	// 存入用户相关COOKIE
	private function setSession($user)
	{
        unset($user['password']);           // 清除密码
        unset($user['encrypt']);            // 清除加密密码
        $_SESSION[$this->session] = $user;  // 数据保存在SESSION中
	}
}
?>