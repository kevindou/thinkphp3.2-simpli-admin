<?php
/**
 * Class IndexAction
 * Desc: 后台用户登录页面
 * User: liujx
 * Date: 2015-11-30
 */
class UsersAction extends CommAction
{
    public $title = '用户列表信息';
    public $model = 'Users';

    // 导入用户的表信息
    private $arrDB = array(
        //  表名                         => 需要处理Int64位的字段
        // 添加的表
        'user_hero_exclusive'           => array('lUserId'),
        'user_lottery_recruit'          => array('lUserId'),
        'user_lottery_recruit_items'    => array('lUserId'),

        'chr_quest_rec'                 => array('lUserId'),
        'dailytaskinfo'                 => array('lUserId'),    // 表需要处理doub_reward_flag
        'duplicatecurinfo'              => array('lUserId'),
        'duplicatehisinfo'              => array('lUserId'),
        'hell_butterfly'                => array('lUserId'),
        'user_achieve'                  => array('lUserId'),
        'user_arena_info'               => array('lUserId'),
        'user_bable'                    => array('lUserId'),
        'user_bet'                      => array('lUserId'),
        'user_betLog'                   => array('lUserId', 'id'),
        'user_black_market'             => array('lUserId'),
        'user_brave_base_info'          => array('lUserId', 'lTargetId'),
        'user_brave_circle_dairy'       => array('lUserId'),
        'user_brave_circle_info'        => array('lUserId'),
        'user_brave_circle_target'      => array('lUserId'),
        'user_catch_slave'              => array('lUserId', 'id', 'canCatchID'),
        'user_change_hero'              => array('lUserId'),
        'user_demon_hero_info'          => array('lUserId', 'lTargetId'),
        'user_equip'                    => array('lUserId', 'itemCode'),
        'user_exp_dup'                  => array('lUserId'),
        'user_exp_duplicate'            => array('lUserId'),
        'user_girlfriend'               => array('lUserId'),
        'user_girlundress'              => array('lUserId'),
        'user_growroad'                 => array('lUserId'),
        'user_growroad_gift'            => array('lUserId'),
        'user_guider'                   => array('lUserId'),
        'user_guild'                    => array('lUserId'),
        'user_guild_raid'               => array('lUserId'),
        'user_guild_raid_count'         => array('lUserId'),
        'user_hd_trial_gift'            => array('lUserId'),
        'user_hero_chip'                => array('lUserId'),
        'user_hero_fight_cur'           => array('lUserId'),
        'user_homeland'                 => array('lUserId'),
        'user_homelandInteractRecord'   => array('lUserId', 'lRecordId', 'lFriendId'),
        'user_humu_market'              => array('lUserId'),
        'user_item'                     => array('lUserId', 'itemCode'),
        'user_jade'                     => array('lUserId', 'lJadeCode'),
        'user_jade_data'                => array('lUserId'),
        'user_knife_strengthen'         => array('lUserId'),
        'user_knifeinfo'                => array('lUserId'), // bUsed => true, false
        'user_knifesoul_info'           => array('lUserId'),
        'user_leader_wake_up'           => array('lUserId'),
        'user_league'                   => array('lUserId'),
        'user_log'                      => array('lUserId'),
        'user_masterbattle'             => array('lUserId'),
        'user_masterpoint'              => array('lUserId'),
        'user_mastersoul'               => array('lUserId'),
        'user_medal_base'               => array('lUserId'),
        'user_medal_module'             => array('lUserId'),
        'user_nightmare_trial'          => array('lUserId'),
        'user_pet_family'               => array('lUserId', 'nVicePetId'),
        'user_pet_info'                 => array('lUserId'),
        'user_related_base_info'        => array('lUserId'),
        'user_related_partner_point'    => array('lUserId'),
        'user_related_partner_skill'    => array('lUserId'),
        'user_skills'                   => array('lUserId'),
        'user_slave'                    => array('lUserId', 'masterID'),
        'user_slave_log'                => array('lUserId', 'id', 'fightReportID'),
        'user_spirit_school'            => array('lUserId'),
        'user_team_raid_count'          => array('lUserId'),
        'user_timeReward'               => array('lUserId'),
        'user_time_market_info'         => array('lUserId'),
        'user_time_market_item'         => array('lUserId'),
        'user_title'                    => array('lUserId'),
        'user_vice_pet'                 => array('lUserId'),
        'user_vice_pet_train'           => array('lUserId', 'lId'),
        'user_wb_applicants'            => array('lUserId'),              // user_wb_applicants
        'user_wb_elite'                 => array('lUserID'),              // ID 等于lUserID
        'user_wb_entrants'              => array('lUserId'),              // user_wb_entrants
        'user_wb_historylog'            => array('lUserId'),
        'user_wb_target'                => array('lUserId'),              // user_wb_target
        'user_welfare'                  => array('lUserId'),
        'user_yellow_vip'               => array('lUserId'),
        'userbanned'                    => array('lUserId'),
        'userbaseinfo'                  => array('lUserId'),
        'userdigging'                   => array('lUserId'),
        'userfightreport'               => array('lUserId', 'fighterId'),
        'userheroinfo'                  => array('lUserId', 'nHeroExp'),
        'userherosoul'                  => array('lUserId'),
        'usermailrec'                   => array('lUserId', 'mailId'),
        'usermailsend'                  => array('lUserId', 'mailId'),
        'usermoney'                     => array('lUserId', 'lSilver'),
        'userpaylogs'                   => array('lUserId'),
        'usersignin'                    => array('lUserId'),
        'uservipinfo'                   => array('lUserId', 'nOfflinePayGold', 'nPayGoldCount', 'nCostGoldCount'),
        'limitInfo'                     => array('lUserId'),
        'mallInfo'                      => array('lUserId'),
        'missioninfo'                   => array('lUserId'),
        'raidersdailyinfo'              => array('lUserId'),
    );

    // 导入交给后台处理的表
    private $hideDB = array('user_vice_pet_train', 'user_vice_pet', 'user_pet_family', 'userheroinfo', 'user_jade', 'user_equip', 'user_item');

    // 显示之前的处理
    public function beforeIndex($model)
    {
        // 添加按钮
        $this->arrTopOperate = array_merge(array(
            'edit'   => array('title' => '修改迁入用户', 'other' => array('id' => 'updateUser')),
            'signin' => array('title' => '导入用户数据', 'other' => array('id' => 'importData')),
        ), $this->arrTopOperate);

        // 默认赋值
        $model->arrUpdateUser['agentid']['value'] =
        $model->arrImport['agentid']['value']     =
        $model->arrAddTh['agentid']['value']      =
        $model->arrShowTh[2]['search']['value']   =  D('Agent')->field('id, cn_name')->findAll(array(
            'index'  => 'id',       // 数组索引
            'keyval' => 'cn_name',  // 值
        ));
        $model->arrAddTh['status']['value']    = $model->arrShowTh[5]['search']['value'] = $this->arrStatus;
        $model->arrEditTh = $model->arrAddTh;
        $model->arrEditTh['password']['other'] = array('rangelength' => '[5,25]', 'm-pass' => true);
        $model->arrEditTh['truepass']['other'] = array('rangelength' => '[5,25]', 'equalTo' =>'input[m-pass=1]');
    }

    // 重新分配信息
    public function allotFluidContent($model)
    {
        $arrAllot = parent::allotFluidContent($model); // TODO: Change the autogenerated stub
        // 导入用户DIV
        $arrAllot[0]['content']['importDiv'] = array(
            'class'   => 'isHide',
            'content' => $this->showForm($model->arrImport, 'importForm'),
        );

        // 迁移修改
        $arrAllot[0]['content']['userDiv'] = array(
            'class'   => 'isHide',
            'content' => $this->showForm($model->arrUpdateUser, 'updateUserForm'),
        );

        return $arrAllot;
    }

    // 表格数据的处理(显示之前的处理)
    public function handleValue(&$arrData, $isAll = true)
    {
        if (false === $isAll) $arrData = array($arrData);

        $arrAids = array();
        foreach ($arrData as $val)$arrAids[] = $val['agentid'];
        // 查询数据
        $arrAgents = D('Agent')->where()->findAll(array(
            'index'  => 'id',
            'keyval' => 'cn_name',
            'id'     => array('in' => array_unique($arrAids))
        ));

        // 处理显示
        foreach ($arrData as &$mval)
        {
            $mval['createTime'] = date('Y-m-d H:i:s', $mval['createTime']);
            $mval['lastTime']   = date('Y-m-d H:i:s',   $mval['lastTime']);
            $mval['updateTime'] = date('Y-m-d H:i:s', $mval['updateTime']);
            $mval['status']     = $this->showStatus($mval['status'], $this->arrStatus, $this->arrColor); // $this->arrStatus[$mval['status']];
            $mval['agentid']    = $arrAgents[$mval['agentid']];
        }

        if (false === $isAll) $arrData = array_shift($arrData);
    }

    // 修改之前的验证
    public function beforeUpdate($model, &$strMsg)
    {
        // 修改之前的验证
        $strMsg   = '用户名已经存在';
        $strWhere = '`username`=\''.$model->username.'\'';
        if (!$model->isNew)  $strWhere .= ' AND `id` != '.$model->id;
        $arrUsers = $model->field('id')->where($strWhere)->find();
        return ! $arrUsers;
    }

    // 查询服务器信息
    public function getLinkAge()
    {
        // 初始化信息
        $arrMsg = $this->arrError;  // 定义错误信息
        $intAid = (int)get('id');        // 接收平台ID

        // 判断数据
        if (!empty($intAid))
        {
            $arrServers = M('server')->where(array('agentid' => $intAid, 'status' => 1))->findAll();
            $arrMsg['msg'] = '该平台没有服务器信息';
            if ($arrServers)
            {
                $arrMsg = $this->arrSuccess;
                $arrMsg['data'] = '<option value="">请选择</option>';
                foreach ($arrServers as $key => $value)$arrMsg['data'] .= '<option value="'.$value['id'].'">'.$value['serverName'].'</option>';
            }
        }

        // 返回数据
        $this->returnAjax($arrMsg);
    }

    // 查询服务器信息
    public function getServer()
    {
        // 初始化信息
        $arrMsg = $this->arrError;  // 定义错误信息
        $intAid = (int)get('aid');  // 接收平台ID
        $intSid = (int)get('sid');  // 接收平台ID

        // 判断数据
        if (!empty($intAid) && ! empty($intSid))
        {
            $arrServers = M('server')->where(array(
                'agentid' => $intAid,
                'id'      => $intSid,
                'status'  => 1))->find();

            $arrMsg['msg'] = '该平台没有服务器信息';
            if ($arrServers)
            {
                $arrMsg = $this->arrSuccess;
                $arrMsg['data'] = $arrServers;
            }
        }

        // 返回数据
        $this->returnAjax($arrMsg);
    }

    // 导入用户数据
    public function import()
    {
        // 接收参数信息
        $username  = post('username');          // 用户账号
        $intAid    = (int)post('agentid');      // 导进平台
        $intServid = (int)post('serverid');     // 导进服务器

        // 导进信息
        $mongohost = post('mongohost');         // 导入MongoDB地址
        $mongoport = post('mongoport');         // 导入MongoDB端口
        $mongoname = post('mongoname');         // 导入MongoDB库

        // 来源信息
        $dbhost    = post('dbhost');            // 来源MongoDB地址
        $dbport    = post('dbport');            // 来源MongoDB端口
        $dbname    = post('dbname');            // 来源MongoDB库
        $intSid    = (int)post('sid');          // 来源服务器ID

        // 定义错误信息
        $arrMsg = $this->arrError;

        // 判断数据的有效性
        if ($mongohost && $mongoport && $mongoname && $dbhost && $dbport && $dbname && $intSid && $intAid && $intServid)
        {
            // 开始连接MongoDB
            $strLoadingIn  = "mongodb://{$mongohost}:{$mongoport}";
            $strLoadingOut = "mongodb://{$dbhost}:{$dbport}";
            try
            {
                set_time_limit(0);
                // 连接导进数据库
                $mongoDB = new Mongo($strLoadingIn);       // 连接Mongo
                $newDB   = $mongoDB->selectDB($mongoname); // 选择库

                $arrMsg['msg'] = '连接导进Mongo数据库出现错误!';
                if (is_object($newDB))
                {
                    try
                    {
                        // 连接来源数据库
                        $mongoDBOld = new Mongo($strLoadingOut);        // 连接Mongo
                        $oldDB      = $mongoDBOld->selectDB($dbname);   // 选择库

                        $arrMsg['msg'] = '连接来源Mongo数据库出现错误!';
                        if (is_object($oldDB))
                        {
                            // 查询用户信息
                            $oldUser = $oldDB->useridinfo->findOne(array(
                                'sUserId'   => $username,
                                'nServerId' => $intSid,
                            ));

                            $arrMsg['msg'] = '来源数据库没有找到用户信息';
                            if ($oldUser)
                            {
                                unset($oldUser['_id']);
                                // 新数据
                                $tmplUserId             = $oldUser['lUserId'];
                                $oldUser['lUserId']     = mInt64($oldUser['lUserId']);
                                $oldUser['nServerId']   = $intServid;
                                $oldUser['nOperatorId'] = $intAid;
                                $newDB->useridinfo->insert($oldUser);

                                // 新增数据
                                try
                                {
                                    // 开始数据的迁移
                                    foreach ($this->arrDB as $key => $value)
                                    {
                                        // 交给后台处理的表,这边不做处理
                                        if (in_array($key, $this->hideDB)) continue;
                                        // 表 user_wb_elite 字段处理
                                        $strKey = $key == 'user_wb_elite' ? 'lUserID' : 'lUserId';
                                        $where  = array($strKey => $oldUser['lUserId']);
                                        // 查询旧数据
                                        $newDB->$key->remove($where);
                                        $cursor = $oldDB->$key->find($where);
                                        while ($cursor->hasNext())
                                        {
                                            $temp = $cursor->getNext();
                                            // 处理Int64
                                            foreach ($value as $kv)
                                            {
                                                if (isset($temp[$kv])) $temp[$kv] = mInt64($temp[$kv]);
                                            }

                                            // 表 user_knifeinfo 特殊字段处理
                                            if ($key == 'user_knifeinfo')   $temp['bUsed']            = (bool)$temp['bUsed'];
                                            // 表 dailytaskinfo 需要处理字段
                                            if ($key == 'dailytaskinfo')    $temp['doub_reward_flag'] = (bool)$temp['doub_reward_flag'];
                                            unset($temp['_id']);
                                            // 新增数据
                                            $newDB->$key->insert($temp);
                                        }

                                    }

                                    // 发送请求给服务器端处理道具信息
                                    $strUrl    = 'http://bleach.sina.gametrees.com/db_item/updateItem.php?';
                                    $arrParams = array(
                                        'uid'       => $tmplUserId,
                                        'dbip'      => $dbhost,
                                        'dbname'    => $dbname,
                                        'dbport'    => $dbport,
                                        'dbipTo'    => $mongohost,
                                        'dbnameTo'  => $mongoname,
                                        'dbportTo'  => $mongoport,
                                    );

                                    $strUrl .= http_build_query($arrParams);
                                    file_get_contents($strUrl);

                                    // 数据导进成功
                                    $arrMsg = $this->arrSuccess;
                                    $arrMsg['url'] = $strUrl;
                                }
                                catch (MongoConnectionException $e)
                                {
                                    $arrMsg['msg'] = '连接来源Mongo数据库出现错误:'.$e->getMessage();
                                }
                            }
                        }

                    }
                    catch (MongoConnectionException $e)
                    {
                        $arrMsg['msg'] = '连接来源Mongo数据库出现错误:'.$e->getMessage();
                    }
                }
            }
            catch (MongoConnectionException $e)
            {
                $arrMsg['msg'] = '连接导进Mongo数据库出现错误:'.$e->getMessage();
            }
        }

        // 返回数据给AJAX
        $this->returnAjax($arrMsg);
    }

    // 修改迁移数据的lUserId
    public function updateUser()
    {
        // 接收参数信息
        $username  = post('username');          // 新的用户lUserId
        $oldUser   = post('oldname');           // 旧的用户lUserId
        $intAid    = (int)post('agentid');      // 导进平台
        $intSid    = (int)post('serverid');     // 导进服务器

        // 导进信息
        $mongohost = post('mongohost');         // 导入MongoDB地址
        $mongoport = post('mongoport');         // 导入MongoDB端口
        $mongoname = post('mongoname');         // 导入MongoDB库

        // 定义错误信息
        $arrMsg = $this->arrError;
        if ($username && $oldUser && $intAid && $intSid && $mongohost && $mongoname && $mongoport)
        {
            // 开始连接MongoDB
            $strLoadingIn = "mongodb://{$mongohost}:{$mongoport}";
            try
            {
                set_time_limit(0);
                // 连接导进数据库
                $mongoDB = new Mongo($strLoadingIn);       // 连接Mongo
                $newDB   = $mongoDB->selectDB($mongoname); // 选择库
                $arrMsg['msg'] = '连接导进Mongo数据库出现错误!';
                if (is_object($newDB))
                {
                    // 查询旧的用户信息是否存在
                    $oldUser = $newDB->useridinfo->findOne(array(
                        'lUserId'     => new MongoInt64($oldUser),
                        'nServerId'   => $intSid,
                        'nOperatorId' => $intAid,
                    ));

                    // 判断新的和旧的用户都存在
                    $arrMsg['msg'] = '查询的旧用户数据不存在';
                    if ($oldUser)
                    {
                        // 查询新用户数据
                        $newUser = $newDB->useridinfo->findOne(array(
                            'lUserId'     => new MongoInt64($username),
                            'nServerId'   => $intSid,
                            'nOperatorId' => $intAid,
                        ));

                        $arrMsg['msg'] = '迁移的新用户数据不存在';
                        if ($newUser)
                        {
                            // 处理查询数据
                            $oldUser['lUserId'] = mInt64($oldUser['lUserId']);
                            $newUser['lUserId'] = mInt64($newUser['lUserId']);

                            // 将用户的基础信息表添加到修改表中
                            $this->arrDB['useridinfo'] = array('lUserId');

                            // 新增数据
                            try
                            {
                                // 开始数据的迁移
                                foreach ($this->arrDB as $key => $value)
                                {
                                    // 表 user_wb_elite 字段处理
                                    $strKey = $key == 'user_wb_elite' ? 'lUserID' : 'lUserId';
                                    // 新lUserId
                                    $where  = array($strKey => $newUser['lUserId']);
                                    // 删除新的用户多余数据
                                    $newDB->$key->remove($where);
                                    // 修改旧的数据的lUserId为新的用户lUserId
                                    $newDB->$key->update(array($strKey => $oldUser['lUserId']), array('$set' => $where), array('multiple' => true));
                                }

                                // 数据导进成功
                                $arrMsg = $this->arrSuccess;
                            }
                            catch (MongoConnectionException $e)
                            {
                                $arrMsg['msg'] = '修改Mongo数据库数据出现错误:'.$e->getMessage();
                            }
                        }
                    }
                }
            }
            catch(Exception $e)
            {
                $arrMsg['msg'] = '连接Mongo数据库出现错误:'.$e->getMessage();
            }
        }

        // 返回数据给AJAX
        $this->returnAjax($arrMsg);
    }
}
?>