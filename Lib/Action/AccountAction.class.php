<?php

/**
 * Class MemberAction
 * Desc: 用户中心控制器
 * User: liujx
 * Date：2015-12-25
 */
class AccountAction extends CommonAction
{
    // 用户首页
    public function index()
    {
        // 验证用户是否已经登录
        $this->checkLogin();

        // 查询用户积分信息
        $arrAccount = M('project_users')->field('account')->where(array('id' => $_SESSION[$this->session]['id']))->find();
        $intAccount = $arrAccount ? $arrAccount['account'] : 0;

        import("ORG.Util.Page");

        // 积分获取状态
        $arrStatus = array('全部', '获得', '使用');

        // 查询用户信息
        $objModel  = M('project_account');

        // 获取查询条件
        $intStatus = post('accountStatus', 0); // 查询状态
        $strWhere  = '`user_id` = ' . $_SESSION[$this->session]['id'];

        // 查询使用积分
        $arrUse    = $objModel->field('SUM(`account`) AS `use`')->where($strWhere.' AND `account` < 0')->find();
        $intUse    = $arrUse ? $arrUse['use'] : 0;

        // 查询获取积分
        $arrGain   = $objModel->field('SUM(`account`) AS `gain`')->where($strWhere.' AND `account` > 0')->find();
        $intGain   = $arrGain ? $arrGain['gain'] : 0;

        if (!empty($intStatus))
        {
            $tmpAnd   = $intStatus == 1 ? '>' : '<';
            $strWhere .= ' AND `account` '.$tmpAnd. ' 0 ';
        }

        // 分页信息
        $intTotal  = $objModel->where($strWhere)->count();
        $objPage   = new Page($intTotal, 15);

        // 分页配置信息
        $objPage->config = array(
            'header' => '条记录',
            'prev'   => '上一页',
            'next'   => '下一页',
            'first'  => '首页',
            'last'   => '尾页',
            'theme'  => '%first% %upPage% %linkPage% %prePage% %downPage% %end% %nextPage% %totalRow% %header% %nowPage%/%totalPage% 页',
        );

        // 查询数据信息
        $strShow   = $objPage->show();
        $strLimit  = $objPage->firstRow.','.$objPage->listRows;
        $orderList = $objModel->where($strWhere)->order('`create_time` DESC')->limit($strLimit)->select();

        // 注入变量
        $this->assign(array(
            'account'       => $intAccount,     // 用户积分
            'use'           => $intUse,         // 使用积分
            'gain'          => $intGain,        // 获取积分
            'strShow'       => $strShow,        // 分页信息
            'accountList'   => $orderList,      // 记录信息
            'accountStatus' => $arrStatus,      // 状态
        ));

        // 加载模板
        $this->display('index');
    }

    // 删除记录
    public function del()
    {
        // 验证用户是否已经登录
        $this->checkLogin();

        // 接收参数
        $intId     = get('id');
        $arrReturn = $this->arrError;
        if ($intId)
        {
            // 删除数据
            $isTrue = M('project_account')->delete($intId);
            $arrReturn['msg'] = $this->strError;
            if ($isTrue) $arrReturn = $this->arrSuccess;
        }

        $this->returnAjax($arrReturn);
    }
}
?>