<?php
    // 配置信息
	return array(
        'APP_DEBUG'	=> true,
		'DB_TYPE'	=> 'mysql', 					// 数据库类型
		'DB_HOST'	=> 'localhost', 				// 数据库朋务器地址
		'DB_NAME'	=> 'gametrees_bmmigrant', 		// 数据库名称
		'DB_USER'	=> 'root', 					    // 数据库用户名
		'DB_PWD'	=> 'gongyan', 					// 数据库密码
		'DB_PORT'	=> '3306', 						// 数据库端口
		'DB_PREFIX'	=> 'gt_', 						// 数据表前缀
		'TMPL_PARSE_STRING'	=> array(
			'__PUBLIC__' 	=> '/Public',
		),
		'TMPL_CACHE_ON'		=>	false,      // 默认开启模板缓存
		'OFFICIAL'			=> 'http://www.gametrees.com',
		'COIN_RATE'			=> 20,			// 充值比例(1:20 => 1人名币 = 20金币)
		'ACCOUNT_RATE'      => 10,          // 充值送积分比例（1:10 => 1积分 对应 10金币）

        'TOKEN_ON'          => false,       // 关闭表单验证
		/* Cookie设置 */
		'COOKIE_EXPIRE'         => 3600,    // Coodie有效期
		'COOKIE_DOMAIN'         => '',      // Cookie有效域名
		'COOKIE_PATH'           => '/',     // Cookie路径
		'COOKIE_PREFIX'         => 'gt_',   // Cookie前缀 避免冲突

		/* 跳转到错误页面 */
        'TMPL_ACTION_ERROR'    => 'Layout:error',
		'TMPL_ACTION_SUCCESS'  => 'Layout:error',
		
		
		//支付宝配置参数
		'alipay_config' => array(
			'partner' 		=> '2088401941526596',   				// 这里是你在成功申请支付宝接口后获取到的PID；
			'key'			=> 'sgmw3s13h0qmycihak43r7kujesfgho8',	// 这里是你在成功申请支付宝接口后获取到的Key
			'sign_type'		=> strtoupper('MD5'),
			'input_charset'	=> strtolower('utf-8'),
			'cacert'		=> getcwd().'\\cacert.pem',
			'transport'		=> 'http',
		),
			
		//以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
		'alipay' => array(
			// 商品名称	
			'subject'		=> '<<死神狂潮>>金币',
			// 这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
			'seller_email'	=> 'zhifubao@gametrees.com',
			// 这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
			'notify_url'	=> 'http://bmmigrant.gametrees.com/notify_url.php',
			// 这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
			'return_url'	=> 'http://bmmigrant.gametrees.com/?m=Pay&a=callback',
			// 支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
			'successpage'	=> 'User/myorder?ordtype=payed',
			// 支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
			'errorpage'		=> 'User/myorder?ordtype=unpay',
		),
	);
?>