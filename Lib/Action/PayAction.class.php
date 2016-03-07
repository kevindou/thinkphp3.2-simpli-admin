<?php

/**
 * Class PayAction
 * Desc: 用户支付页面
 * User: liujx
 * Date: 2016-1-5
 */

class PayAction extends CommonAction
{	
    // 首页显示
	public function index()
	{
		// 验证登录
        $this->checkLogin();

        // 查询服务器信息
        $arrAgents = M('project_agent')->field('`id` AS `gid`, `cn_name` AS `gamename`')->where(array('recharge_status' => 1))->order('`id` ASC')->select();

        // 注入变量载入视图
        $this->assign('games', $arrAgents);
        $this->display();
	}

    // 游戏充值
    public function games_pay()
    {
        exit;
        $this->checkLogin();
        $this->display('games_pay');
    }

    // 游戏充值开始支付
    public function begin_gemes_pay()
    {
        exit;
        $this->checkLogin();
        // 接收参数
        $intMoney  = (int)post('pay_amount');   // 选择金额
        $intAmount = (int)post('pay_money');    // 填写金额
        if (empty($intMoney)) $intMoney = $intAmount;
        $strMsg    = '提交充值金额错误';
        if ( ! empty($intMoney))
        {
            $strOrder = date('YmdHis').mt_rand(1, 9).mt_rand(1, 9);  // 订单号
            // 开始新增订单数据
            $this->createOrder($_SESSION[$this->session]['id'], $_SESSION[$this->session]['username'], $strOrder, 0, 0, $intMoney, time(), $strMsg);
        }

        $this->assign('jumpUrl', '/');
        $this->error($strMsg);
    }

    // 订单支付
    public function go_pay()
    {
        $this->checkLogin();
        // 接收参数
        $intId  = (int)get('order_id');
        $strMsg = '支付订单信息不存在,请确认...';
        if (!empty($intId))
        {
            // 查询订单信息
            $strMsg   = '订单信息不存在或者已经支付,请确认...';
            $model    = M('project_order');
            $arrOrder = $model->field('order_id, money')->where(array(
                'id'      => $intId,                            // 订单ID
                'user_id' => $_SESSION[$this->session]['id'],   // 自己的订单
                'status'  => 0                                  // 没有支付订单
            ))->find();

            if ($arrOrder)
            {
                // 去支付
                $strAlipay = $this->alipay($arrOrder['order_id'], $arrOrder['money'], get_client_ip());
                $strMsg    = '您好！现在正在为您跳转到支付宝支付页面,请稍候...';
                $this->assign(array(
                    'isSkip' => 'false',
                    'alipay' => $strAlipay,
                ));
            }
        }

        $this->success($strMsg);
    }

	// 开始支付
	public function begin_pay()
    {
         $this->checkLogin();
		// 接收参数信息
        $strUser  = htmlspecialchars(post('suid'));             // 游戏平台UID账号
        $strTrue  = htmlspecialchars(post('re_suid'));          // 确认游戏平台UID账号
        $strOrder = date('YmdHis').mt_rand(1, 9).mt_rand(1, 9); // 订单号
        $intAid   = (int)post('game_id');                       // 游戏平台ID
        $intSid   = (int)post('server_id');                     // 服务器ID
        $intPay   = abs(htmlspecialchars(post('pay_amount')));  // 充值金额
        $intOthe  = abs(htmlspecialchars(post('pay_money')));  // 订单金额

        // 判断数据的有效性
        if (!empty($intOthe)) $intPay = $intOthe;               // 不能为空
        $strMsg = '订单信息不完整,请完善您的订单信息再进行提交...';
        if (!empty($strUser) && $strUser == $strTrue && !empty($strOrder) && !empty($intPay) && strlen($strUser) > 2)
        {
            // 判断用户信息是否存在
            $arrResult = $this->get_userRole($intAid, $intSid, $strUser);
            $strMsg    = '你的输入有误,此用户名未创建角色...';
            if ($arrResult['status'] == 1)
            {
                // 查询平台信息
                $arrAgent = M('project_agent')->where(array('id' => $intAid))->find();
                $strMsg   = '对不起,你充值的游戏不存在,请联系客服处理...';
                if ($arrAgent)
                {
                    // 查询服务器信息数据
                    $arrServer = M('project_server')->where(array('id' => $intSid, 'agentid' => $intAid, 'status' => 1))->find();
                    $strMsg    = '对不起,您充值的服务器不存在或者已经停服...';
                    if ($arrServer)
                    {
                        $strMsg  = '对不起,您充值的服务器开放时间为:'.date('Y年m月d日 H:i', $arrServer['open_time']).'，请您届时再开始充值 ^ ^.';
                        $intTime = time();
                        if ($arrServer['open_time'] < $intTime)
                        {
                            // 开始新增订单数据(成功去支付)
                            $this->createOrder($_SESSION[$this->session]['id'], $strUser, $strOrder, $intAid, $intSid, $intPay, $intTime, $strMsg);
                        }
                    }
                }
            }
        }

        // 提示错误信息
        $this->assign('jumpUrl', '?m=Pay&pitch=pay');
        $this->error($strMsg);
	}

    /**
     * createOrder() 生成订单, 跳转到支付宝页面
     * @access private
     * @param  int      $intUid   用户ID
     * @param  string   $strUser  用户名
     * @param  string   $strOrder 订单号
     * @param  int      $intAid   平台ID
     * @param  int      $intSid   服务器ID
     * @param  int      $intMoney 支付金额
     * @param  int      $intTime  生成时间
     * @param  string   $strMsg   提示信息
     */
    private function createOrder($intUid, $strUser, $strOrder, $intAid, $intSid, $intMoney, $intTime, &$strMsg)
    {
        // 开始新增订单数据
        $arrInsert = array(
            'user_id'    => $intUid,
            'user'       => $strUser,
            'order_id'   => $strOrder,
            'game_id'    => $intAid,
            'server_id'  => $intSid,
            'money'      => $intMoney,
            'amount'     => $intMoney * C('COIN_RATE'),
            'createtime' => $intTime,
        );

        $intTrue = M('project_order')->add($arrInsert);
        $strMsg  = '服务器繁忙,请稍候再试...';
        if ($intTrue)
        {
            // 记录支付日志
            $arrInsert['remark']     = '下单未付款';
            $arrInsert['createtime'] = date('Y-m-d H:i:s', $intTime);
            $arrInsert['client_ip']  = get_client_ip();
            $this->wirte_log_pay(array(
                'file' => 'begin_pay',
                'data' => json_encode($arrInsert),
            ));

            // 定义请求支付宝信息 (orderid, total_fee, exter_invoke_ip)
            $strAlipay = $this->alipay($strOrder, $intMoney, $arrInsert['client_ip']);

            // 分配变量
            $this->assign(array(
                'alipay' => $strAlipay,         // 支付宝跳转信息
                'isSkip' => 'false'             // 不跳转
            ));
            $strMsg = '您好！现在正在为您跳转到支付宝支付页面,请稍候...';
        }
    }

    /**
     * alipay() 支付宝订单生成和跳转到支付宝页面
     * @access private
     * @param  string $strOrder 我们的订单号
     * @param  int    $intMoney 支付金额
     * @param  string $strIp    客户端的IP
     * @return string
     */
    private function alipay($strOrder, $intMoney, $strIp)
    {
        // 加载类文件
        $dir = $_SERVER ['DOCUMENT_ROOT'];
        require $dir . '/Lib/Pay/alipay/lib/alipay_submit.class.php';

        // 加载配置信息
        $alipay_config	= C('alipay_config'); 	        // 加载配置文件
        $alipay			= C('alipay'); 			        // 加载配置文件
        C('TOKEN_ON', false);	                        // 局部关闭THINKPHP 表单令牌

        // 构造要请求的参数数组(无需改动)
        $parameter = array(
            "service"           => "create_direct_pay_by_user",
            "partner" 			=> trim($alipay_config['partner']),
            "payment_type"		=> "1",                                  // 支付类型(必填,不能修改)
            "notify_url"		=> $alipay['notify_url'],	             // 服务器异步通知页面路径
            "return_url"		=> $alipay['return_url'], 	             // 页面跳转同步通知页面路径,
            "seller_email"		=> $alipay['seller_email'],	             // 卖家支付宝帐户必填,
            "out_trade_no"		=> $strOrder,		                     // 商户订单号 通过支付页面的表单进行传递，注意要唯一！,
            "subject"			=> $alipay['subject'],  		         // 订单名称(必填 通过支付页面的表单进行传递),
            "total_fee"			=> $intMoney,   	                     // 付款金额(必填 通过支付页面的表单进行传递)
            "body"				=> '',                                   // 订单描述 通过支付页面的表单进行传递
            "show_url"			=> '',                                   // 商品展示地址 通过支付页面的表单进行传递
            "anti_phishing_key"	=> '',                                   // 防钓鱼时间戳(若要使用请调用类文件submit中的query_timestamp函数)
            "exter_invoke_ip"	=> $strIp,                               // 客户端的IP地址
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        // 建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        return $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
    }

    /**
     * callback() 支付宝充值成功回调页面
     */
	public function callback()
    {
        // 交个充值处理函数处理
        $arrInfo = $this->payResponse();
        if ($arrInfo['status'] == 1)    // 充值成功
        {
            $strUrl   = '?m=Member&a=memberPay&pitch=memberPay';
            // 注入变量
            $this->assign(array(
                'title'      => '操作成功',
                'jumpUrl'    => $strUrl,
                'indexTitle' => '去查看',
                'indexUrl'   => $strUrl,
            ));
        }

        $this->success($arrInfo['msg']);
	}	

    // 异步通知
	public function notify()
    {
        // 交给 响应支付宝充值函数处理
        $arrInfo = $this->payResponse();
        $strMsg = $arrInfo['status'] == 1 ? 'success' : 'fail';
        exit($strMsg);
	}


    /**
     * payResponse() 响应支付宝充值
     * @access private
     * @return array array(
            'status' => 0, 状态（0 失败, 1 成功）
            'msg'    => '错误信息'
     * )
     *  同步回调参数(充值成功支付宝返回数据)
        [buyer_email]  => shzark@hotmail.com
        [buyer_id]     => 2088202653631688
        [exterface]    => create_direct_pay_by_user
        [is_success]   => T
        [notify_id]    => RqPnCoPT3K9%2Fvwbh3InR9P5NFFdZ5yTGLYeFH7HXHHdpe3OgC6R8VTeMITPkO6oHDKna
        [notify_time]  => 2014-07-21 22:05:00
        [notify_type]  => trade_status_sync
        [out_trade_no] => 2014072121594312159435
        [payment_type] => 1
        [seller_email] => zhifubao@gametrees.com
        [seller_id]    => 2088401941526596
        [subject]      => 《死神狂潮》金币
        [total_fee]    => 1.00
        [trade_no]     => 2014072128920268
        [trade_status] => TRADE_SUCCESS
        [sign]         => bcedde84d753025b5440a959a9d7e354
        [sign_type]    => MD5
     */
    private function payResponse()
    {
        // 接收参数
        $httpData = $_REQUEST;
        $httpData['client_ip'] = get_client_ip();

        // 记录日志
        $this->wirte_log_pay(array(
            'file' => 'callback',
            'data' => json_encode($httpData),
        ));

        // 引入配置文件信息
        $dir = $_SERVER['DOCUMENT_ROOT'];
        require $dir.'/Lib/Pay/alipay/lib/alipay_notify.class.php';
        $alipay_config = C('alipay_config'); 	                    // 加载配置文件
        $alipayNotify  = new AlipayNotify($alipay_config);
        $isTrue        = $alipayNotify->verifyReturn();	            // 支付验证

//         $isTrue = true; // 测试数据

        // 初始化定义
        $strMsg        = '验证失败,非法请求';
        $intStatus     = 0;
        $arrOrder      = array();

        // 验证通过
        if ($isTrue)
        {
            // 接收参数
            $strOrder   = $httpData['out_trade_no'];                  // 商户订单号
            // $strTradeNo = $httpData['trade_no'];                   // 支付宝交易号
            $intStatus  = $httpData['trade_status'];                  // 交易状态
            $intTotal   = $httpData['total_fee'];                     // 支付金额

            // 判断请求(支付状态)
            $strMsg = '支付状态出现问题：trade_status='.$intStatus;
            if ($intStatus == 'TRADE_FINISHED' || $intStatus == 'TRADE_SUCCESS')
            {
                // 交易完成 || 支付成功
                $objModel = M('project_order');                        // 模型对象
                $arrWhere = array('order_id' => $strOrder);            // 查询条件
                $arrOrder = $objModel->where($arrWhere)->find();       // 查询数据
                $strMsg   = '充值失败!订单号不存在!!!';
                if ($arrOrder)
                {
                    // 充值信息
                    $intAid  = $arrOrder['game_id'];                    // 平台ID
                    $intSid  = $arrOrder['server_id'];                  // 服务器ID
                    $strUser = $arrOrder['user'];                       // 充值用户

                    // 订单判断(只有状态在0的情况下处理)
                    $strMsg = '订单已经支付过,请到在个人中心充值记录中确认...';
                    $strTi  = '您的订单('.$strOrder.')充值成功,请到个人中心充值记录中确认...';
                    if (empty($arrOrder['status']))
                    {
                        $strMsg    = '系统发生错误,更新订单状态失败.请联系客服解决. *_*';
                        $tmpStatus = 1;
                        // 默认使用的（游戏充值, 选择平台和服务器会到平台和服务器发送金币）
                        if ( ! empty($intAid) && ! empty($intSid))
                        {
                            // 发送金币
                            $arrResult = $this->post_payment($intAid, $intSid, $strUser, $strOrder, $intTotal);
                            if ($arrResult)
                            {
                                $tmpStatus = 2;

                                // 查询充值记录是否存在
                                $isHave    = M('project_account')->where(array(
                                    'user_id'  => $_SESSION[$this->session]['id'],
                                    'order_id' => $arrOrder['id']
                                ))->find();

                                // 判断不存在
                                if ( ! $isHave)
                                {
                                    $intAccount = $arrOrder['amount'] / C('ACCOUNT_RATE');
                                    // 修改用户积分
                                    $isTrue     = M('project_users')->setInc('account', 'id='.$_SESSION[$this->session]['id'], $intAccount);
                                    // 添加积分记录
                                    if ($isTrue)
                                    {
                                        // 添加记录
                                        M('project_account')->add(array(
                                            'user_id'     => $_SESSION[$this->session]['id'],
                                            'account'     => $intAccount,
                                            'order_id'    => $arrOrder['id'],
                                            'desc'        => '订单'.$strOrder.'充值'.$arrOrder['amount'].'金币,赠送'.$intAccount.'积分',
                                            'create_time' => time(),
                                        ));
                                    }
                                }
                            }
                            else
                                $strTi = '游戏充值接口加载失败,请联系客服处理...';
                        }

                        $isTrue = $objModel->where($arrWhere)->save(array('status' => $tmpStatus));
                        if ($isTrue)
                        {
                            $intStatus = 1;
                            $strMsg    = $strTi;
                        }
                    }
                    else if ($arrOrder['status'] == 2)
                    {
                        $intStatus = 1;
                        $strMsg    = $strTi;
                    }
                }
            }
        }

        // 返回信息
        return array(
            'status' => $intStatus,     // 状态
            'msg'    => $strMsg,        // 错误信息
            'data'   => $arrOrder,      // 订单信息
        );
    }

    // getUserInfo() 获取用户游戏平台信息
    public function getUserInfo()
    {
        // 验证登录
        $this->checkLogin();
        // 接收参数
        $intGid = (int)post('gid');     // 游戏平台ID
        $intSid = (int)post('sid');     // 游戏服务器ID
        $strUid = post('suid');         // 用户UID
        // 验证数据的有效性
        $arrError = $this->arrError;
        if ($intGid && $intSid && $strUid)
        {
            // 定义错误信息
            $arrError = array(
                -4 => '充值游戏UID信息不存在', -3 => '服务器信息错误或者还没有开服,请耐心等待...', -2 => '验证签名失败', -1 => '接口接收信息错误',
                0 =>'提交参数错误', '获取用户游戏信息成功', '平台信息错误', '服务器繁忙,请稍候再试...'
            );

            // 请求接口获取数据信息
            $arrUserInfo = $this->get_userRole($intGid, $intSid, $strUid);

            // 重新定义返回数据
            $arrError['status'] = $arrUserInfo['status'];
            $arrError['msg']    = $arrError[$arrUserInfo['status']];
            $arrError['data']   = $arrUserInfo['result'];
        }

        $this->returnAjax($arrError);
    }

    /**
     * get_userRole() 获取用户角色名
     * @param int       $intAid     平台ID
     * @param int       $intSid     服务器ID
     * @param string    $strUid     用户游戏UID
     * @return array
     */
	private function get_userRole($intAid, $intSid, $strUid)
    {
        // 定义返回数据
        $arrResult = array(
            'status' => 0,
            'result' => array(),
        );
	    // 判断数据的有效性
        if ($intAid && $intSid && $strUid)
        {
            // 查询平台信息
            $model    = M('project_agent');
            $arrAgent = $model->field('loginSecret,apiUrl')->where(array('id' => $intAid))->order('id ASC')->find();
            $arrResult['status'] = 2;
            if ($arrAgent)
            {
                // 定义发送信息
                $strUrl   = trim($arrAgent['apiUrl'], '/').'/getUserInfo.php';  // 请求接口
                $strToken = $arrAgent['loginSecret'];                           // 验证ToKen
                $intTime  = time();                                             // 请求时间

                // 处理参数发送请求
                $arrData   = $this->packageParameter($strUrl, array(
                    'uid'      => $strUid,     // 用户游戏UID
                    'agentid'  => $intAid,     // 游戏平台ID
                    'serverid' => $intSid,     // 用户游戏服务器ID
                    'time'     => $intTime,    // 请求时间戳
                    'sign'     => md5($strUid.$intAid.$intSid.$intTime.$strToken),  // 验证密钥
                ));

                // 返回数据
                $arrUser = $this->getResult($arrData['url'], $arrData['data']);
                $arrUser = json_decode($arrUser, true);

                // 成功获取数据
                if ($arrUser)
                    $arrResult = $arrUser;
                else
                    $arrResult['status'] = 3;
            }
        }

        return $arrResult;
	}

    /**
     * post_payment() 调用充值接口
     * @param int    $intAid      平台ID
     * @param int    $intSid      服务器ID
     * @param string $strUid      用户平台平台UID
     * @param string $strOrderId  订单号
     * @param int    $intTotal    订单金额
     * @return mixed
     */
	private function post_payment($intAid, $intSid, $strUid, $strOrderId, $intTotal)
    {
		$intTotal = intval($intTotal);      // 订单金额
        $arrAgent = M('project_agent')->field('loginSecret,apiUrl')->where(array('id' => $intAid))->order('id ASC')->find();

        // 数据的有效性
        $strMsg = '游戏平台不存在';
        if ($arrAgent)
        {
            // 定义请求信息
            $strUrl  = trim($arrAgent['apiUrl'], '/').'/payment.php';  // 支付地址
            // 处理请求信息
            $arrData = $this->packageParameter($strUrl, array(
                'uid'          => $strUid,      // 用户平台ID,
                'agentid'      => $intAid,      // 平台ID
                'server_id'    => $intSid,      // 服务器ID
                'order_id'     => $strOrderId,  // 订单ID
                'order_amount' => $intTotal,    // 订单金额
                'source'       => 1,            // 订单来源(1表示的是GS官网)
                'sign'         => md5($strUid.$intTotal.$strOrderId.$intSid.$arrAgent['loginSecret']),
            ));

            // 发送请求
            $arrResult = $this->getResult($arrData['url'], $arrData['data']);

            // 记录日志信息
            $arrLog = array(
                'request_url' => $arrData['url'].'?'.$arrData['data'],  // 请求地址信息
                'retval'      => $arrResult,                            // 返回信息
            );

            // 转文件格式
            $this->wirte_log_pay(array(
                'file' => 'pay_callback',       // 记录日志文件
                'data' => json_encode($arrLog), // 记录信息
            ));

            // 返回数据
            return $arrResult;
        }

        // 载入信息
        $this->assign('jumpUrl', '/');
        $this->error($strMsg);
	}


    /**
     * getResult() 获取接口返回数据信息
     * @param  string $strUrl  发送的接口地址
     * @param  string $strData 发送的接口参数信息
     * @return mixed  返回接口信息
     */
	private function getResult($strUrl, $strData)
    {
		$curl = curl_init($strUrl);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);  
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $strData);
		$res = curl_exec($curl);
		if (curl_errno($curl))
		{
			echo 'Curl error: ' . curl_error($curl);
		}

		curl_close($curl);
		return $res;
	}

    /**
     * packageParameter() 处理发送的请求参数
     * @param  string $strUrl  发送地址
     * @param  array  $arrData 发送的参数
     * @return array
     */
	private function packageParameter($strUrl, $arrData)
    {
        $arrResult = array('url' => $strUrl, 'data' => '');
        if (!empty($strUrl) && ! empty($arrData))
        {
            $data = array();
            foreach ($arrData as $key => $value) $data[] = $key.'='.urlencode($value);
            $arrResult['data'] = implode('&', $data);
        }

		return 	$arrResult;
	}
}
?>