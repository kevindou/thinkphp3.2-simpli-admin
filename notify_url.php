<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */
error_reporting(0); // 关闭错误信息

// 接收参数写入日志
$httpData = $_REQUEST;
$data     = 'parameter : '.json_encode($httpData);
writelog($data);

// 引入配置文件信息
require_once('Mysql.Class.php');
require_once('./Lib/Pay/alipay/lib/alipay_notify.class.php');	
$config = include './Conf/config.php';

// 计算得出通知验证结果
$alipay_config = $config['alipay_config'];
$alipayNotify  = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

// $verify_result = true; // 测试时开启

// 初始化定义错误信息
$strMsg        = 'fail';

// 判断验证信息
if ($verify_result)
{
	// 接收返回信息
	$order_id 	  = $httpData['out_trade_no'];  // 商户订单号
	$trade_no 	  = $httpData['trade_no'];      // 支付宝交易号
	$trade_status = $httpData['trade_status'];  // 交易状态
	$total_fee	  = $httpData['total_fee'];	    // 支付金额

	// 查找存在该订单并且状态为未支付的	
	$strSQL = "SELECT * FROM `gt_project_order` WHERE `order_id` = '{$order_id}'";
	$Order  = MysqlHelp::getInstance()->getRow($strSQL);	

    // 判断支付状态
	if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS')
    {
        if ($Order['status'] != 2)
        {
            // 游戏ID , 服务器ID	 充值到游戏帐号
            $aid 		= $Order['game_id'];        // 平台ID
            $server_id 	= $Order['server_id'];	    // 服务器ID
            $strUid	    = $Order['user'];	        // 用户游戏UID

            // 我们自己平台的充值
            $intStatus = 1;
            if ( ! empty($aid) && ! empty($server_id))
            {
                $isTrue = post_payment($aid, $server_id, $strUid, $order_id, $total_fee);
                if ($isTrue)
				{
					$intStatus  = 2;

					// 充值成功赠送积分
					$strSql     = "SELECT * FROM `gt_project_account` WHERE `order_id` = {$Order['id']} AND `user_id` = {$Order['user_id']} LIMIT 1";
					$arrAccount = MysqlHelp::getInstance()->getRow($strSql);

					// 判断是否已经赠送，没有才赠送
					if ( ! $arrAccount)
					{
						$intAccount = floor($Order['amount']/$config['ACCOUNT_RATE']);
						// 修改用户的积分信息
						$strSql 	= "UPDATE `gt_project_users` SET `account` = `account` + {$intAccount} WHERE `id` = {$Order['user_id']}";
						$isTrue     = MysqlHelp::getInstance()->query($strSql);
						if ($isTrue)
						{
							// 添加记录信息
							MysqlHelp::getInstance()->insert('gt_project_account', array(
								'user_id'     => $Order['user_id'],
								'account'     => $intAccount,
								'order_id'    => $Order['id'],
								'desc' 	      => '订单'.$order_id.'充值'.$Order['amount'].'金币,赠送'.$intAccount.'积分',
								'create_time' => time(),
							));
						}
					}
				}
            }

            // 修改订单信息
            $strSql = "UPDATE `gt_project_order` SET `status` = {$intStatus} WHERE `order_id` = '{$order_id}'";
            MysqlHelp::getInstance()->query($strSql);
        }
	}

    $strMsg = 'success';
}

// 处理记录日志返回
writeLog($strMsg);
exit($strMsg);

/**
 * writeLog() 写入日志信息
 * @param $msg
 */
function writeLog($msg)
{
	$filename = './log/'. date ( 'Ymd').'.log';	
	$fp = fopen($filename, 'a+');
	fwrite($fp, $msg."\r\n\n");
	fclose($fp);
}

/**
 * payment() 调用充值信息
 * @param   int     $aid          平台ID
 * @param   int     $server_id    服务器ID
 * @param   string  $strUid       用户充值游戏UID
 * @param   string  $order_id     充值订单号
 * @param   int     $total_fee    充值金额
 * @return  int|mixed
 */
function post_payment($aid, $server_id, $strUid, $order_id, $total_fee)
{
    // 初始化处理
	$amount     = intval($total_fee);
	$strSQL 	= "SELECT `loginSecret`, `apiUrl` FROM `gt_project_agent` WHERE `id`={$aid}";
	$agentInfo 	= MysqlHelp::getInstance()->getRow($strSQL);
    $intStatus  = -3;   // 游戏不存在
    if ($agentInfo)
    {
        $secret = $agentInfo['loginSecret'];
        $url 	= trim($agentInfo['apiUrl'], '/').'/payment.php'; // 请求接口名称
        $params = array(
            'uid'          => $strUid,         // 用户游戏平台ID
            'agentid'      => $aid,            // 游戏平台ID
            'server_id'    => $server_id,      // 游戏服ID
            'order_id'     => $order_id,       // 支付订单号
            'order_amount' => $amount,         // 充值金额
            'source'       => 1,               // 订单来源(1表示的是GS官网)
            'sign'         => md5($strUid.$amount.$order_id.$server_id.$secret),    // 验证密钥
        );

        $intStatus = packageParameter($url, $params);
    }

    // 返回状态
    return $intStatus;
}

/**
 * packageParameter()处理请求参数
 * @param  string  $url 请求地址
 * @param  array   $p
 * @return mixed
 */
function packageParameter($url, $p)
{
    $strParams = '';
    if (is_array($p)) $strParams = http_build_query($p);
	$retval = getResult($url, $strParams);
	$msg    = "post:{$url}?{$strParams}  return: {$retval} ";
	writeLog($msg);
	return $retval;
}

/**
 * getResult()
 * @param  string $url    发送的地址信息
 * @param  array  $data   携带的参数信息
 * @return mixed 返回信息
 */
function getResult($url, $data)
{
	// 初始化请求
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);  
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // 获取返回信息
	$res = curl_exec($curl);

    // 判断错误
	if (curl_errno($curl)) echo 'Curl error: ' . curl_error($curl);
	curl_close($curl);
	return $res;
}
?>