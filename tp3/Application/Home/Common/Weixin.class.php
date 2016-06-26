<?php
/**
 * Created by PhpStorm.
 * User: love
 * Date: 2015/11/15
 * Time: 15:04
 */
namespace Home\Common;

// 定义TOKEN
define('TOKEN', 'mylx821901008');

class Weixin
{
    // 验证函数
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    // 响应信息
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        // $GLOBALS["HTTP_RAW_POST_DATA"]功能与$_POST类似用于接收HTTP POST数据，两者不同在于GLOBALS可以接收xml数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            // 解析 xml 时，不解析 entity 实体（ 防止产生文化泄露 ）
            libxml_disable_entity_loader(true);
            // simplexml_load_string 载入xml 到字符串
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            // 用户微信段（手机端）
            $fromUsername = $postObj->FromUserName;
            // 微信公众平台
            $toUsername = $postObj->ToUserName;

            // 信息内容类型
            $msgType = $postObj->MsgType;

            // 定义 Event 接收Event 事件
            $event = $postObj->Event;

            // 接收用户发过来的数据，存储在 $keyword 里面
            $keyword = trim($postObj->Content);
            // 时间戳
            $time = time();

            // 定义文本消息 xml 模板
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            $musicTpl = "<xml>
							 <ToUserName><![CDATA[%s]]></ToUserName>
							 <FromUserName><![CDATA[%s]]></FromUserName>
							 <CreateTime>%s</CreateTime>
							 <MsgType><![CDATA[%s]]></MsgType>
							 <Music>
								<Title><![CDATA[%s]]></Title>
								<Description><![CDATA[%s]]></Description>
								<MusicUrl><![CDATA[%s]]></MusicUrl>
								<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
							 </Music>
							 </xml>";
            $newsTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
							 	<FromUserName><![CDATA[%s]]></FromUserName>
							 	<CreateTime>%s</CreateTime>
							 	<MsgType><![CDATA[%s]]></MsgType>
							 	<ArticleCount>%s</ArticleCount>
								%s
								</xml> ";
            // 判断消息类型
            switch ( $msgType ) {
                case 'text':		// 文本类型
                    // 判断文本信息内容
                    if ( !empty( $keyword) ) {
                        switch ($keyword) {
                            case 1:			// 工作室简介(图文信息)
                                $msgType = 'news';
                                // 配置图文信息
                                $arrMessage = array(array(
                                    'title'       => '刘星工作室',
                                    'description' => '刘星工作室',
                                    'picUrl'      => 'jinsha1.jpg',
                                    'url'         => '',
                                ),array(
                                    'title'       => '我的个人微博',
                                    'description' => '我的个人微博',
                                    'picUrl'      => 'me.jpg',
                                    'url'         => '',
                                ), array(
                                    'title'       => 'I love  you',
                                    'description' => '我爱你',
                                    'picUrl'      => 'mylove.jpg',
                                    'url'         => 'Home/Weixin/love.html',
                                ), array(
                                    'title'       => '七夕主题页面',
                                    'description' => '七夕主题页面',
                                    'picUrl'      => 'jinsha2.jpg',
                                    'url'         => 'Home/Weixin/qixi.html',
                                ));

                                $imgUrl = 'http://mylx.sinaapp.com/Public/Home/images/';
                                $strUrl = 'http://mylx.sinaapp.com/';

                                // 图片数据显示
                                $news = '<Articles>';
                                foreach ($arrMessage as $value)
                                {
                                    $value['picUrl'] = $imgUrl.$value['picUrl'];
                                    $value['url']    = $strUrl.$value['url'];
                                    $news .= "<item>
												 <Title><![CDATA[{$value['title']}]]></Title>
												 <Description><![CDATA[{$value['description']}]]></Description>
												 <PicUrl><![CDATA[{$value['picUrl']}]]></PicUrl>
												 <Url><![CDATA[{$value['url']}]]></Url>
												 </item>
										 ";
                                }
                                $news .= '</Articles>';
                                $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,count($arrMessage),$news);
                                // 输出响应内容
                                echo $resultStr;
                                exit;
                                break;
                            case 2:			// 工作室作品
                                $contentStr = '抱歉！工作的室现在才成立，没有作品哦！';
                                break;
                            case 3:			// 联系我们
                                $contentStr = "我的手机：17091262215\n我的邮件：821901008@qq.com\n我的QQ：821901008";
                                break;
                            case 4:			// 天气查询
                                $contentStr = '今天天气很好！';
                                break;
                            case 5:			// 位置查询
                                $contentStr = '我还不知道怎么获取你的地址，需要你告诉我哦！';
                                break;

                            case '音乐':	// 音乐(音乐信息)

                                // 回复信息类型
                                $msgType = 'music';
                                $title = '金莎-星月神话';
                                $description = '最近喜欢听的音乐';
                                $url = 'http://mylx.sinaapp.com/Public/Weixin/music/music.mp3';
                                $hqurl = 'http://mylx.sinaapp.com/Public/Weixin/music/music.mp3';
                                $resultStr = sprintf($musicTpl, $fromUsername, $toUsername, $time, $msgType, $title,$description,$url,$hqurl);
                                // 输出响应内容
                                echo $resultStr;
                                exit;
                                break;

                            // mylovogongyan
                            default:		// 机器人回复
                                // 设置头信息
                                header('Content-type:text/html;charset=UTF-8');
                                // 提交到的远程页面
                                $url = "http://www.niurenqushi.com/app/simsimi/ajax.aspx";
                                // 1、初始化CURL
                                $ch = curl_init();
                                // 2、设置参数
                                // 设置请求url网址
                                curl_setopt($ch,CURLOPT_URL,$url);
                                // 捕获url响应信息不输出
                                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                                // 设置请求头信息
                                curl_setopt($ch,CURLOPT_HEADER,0);
                                // 3、设置传输POST数组
                                $data = array('txt'=>$keyword);
                                // 4、设置开启POST请求
                                curl_setopt($ch,CURLOPT_POST,1);
                                // 5、传输参数值
                                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                                // 6、执行curl
                                $contentStr = curl_exec($ch);
                                // 7、关闭句柄
                                curl_close($ch);

                        }

                    } else {
                        echo "Input something...";
                        exit;
                    }

                    break;
                case 'event':		// 关注和取消关注事件
                    if ( $event == 'subscribe' ) {
                        // 返回响应回复
                        $contentStr = "欢迎光临刘星工作室,感谢您的关注!\n回复\n【1】工作室简介\n【2】工作室作品\n【3】联系我们\n【4】天气查询\n【5】位置查询";
                    }

                    break;
                case 'image':		// 图片类型
                    $contentStr = '你的图片不会有不良信息吧？';
                    break;
                case 'voice':		// 语音类型
                    $contentStr = '您的声音好好听哦！';
                    break;
                case 'video':		// 视频类型
                    $contentStr = '我不喜欢看视频！';
                    break;
                case 'location':	// 地理位置

                    // 获取位置信息(经纬度)
                    $longitude = $postObj->Location_Y;
                    $latitude = $postObj->Location_X;

                    // API 接口
                    $url = "http://api.map.baidu.com/telematics/v3/reverseGeocoding?location={$longitude},{$latitude}&coord_type=gcj02&ak=9e30wWZSmzqbNKuXQy1dK9F0&output=json";
                    // 获取数据
                    $str = file_get_contents($url);
                    $json = json_decode($str);
                    // 回复信息 $json->descript 地点描述
                    $contentStr = '我已经锁定你的位置:'.$json->description.',小样你跑啊！';

                    break;
                case 'link':		// 连接地址

                    break;
                default:

            }
            // 定义返回消息的类型( text 文本 )
            $msgType = "text";
            // sprintf()函数，用来把字符串格式化输出 %s 表示字符串类型
            // 有两个重要的参数(格式化字符串，格式化变量)
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            // 输出响应内容
            echo $resultStr;

        }else {
            echo "";
            exit;
        }
    }

    // 校检签名
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        // 接收参数
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);		// 排序
        $tmpStr = implode( $tmpArr );	// 拼接成字符串
        $tmpStr = sha1( $tmpStr ); 		// 加密
        return $tmpStr == $signature;
    }
}
?>