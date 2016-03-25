<?php
/**
 * Class AccountAction
 * Desc: 后台用户积分记录列表
 * User: liujx
 * Date: 2016-02-17
 */
class AccountAction extends CommAction
{
    // 初始化定义
    public $title   = '积分记录';
    public $model   = 'Account';
    public $strSort = 'create_time DESC';

    // 定义操作按钮(表格中的数据)
    public $arrOperateButton = array(
        'edit'    => array('title' => '修改', 'other' => array('class' => 'btn btn-info btn-edit')),
        'trash'   => array('title' => '删除', 'other' => array('class' => 'btn btn-danger btn-delete')),
    );

    // 显示之前处理
    public function beforeIndex($model)
    {
        // 注入排序信息
        $this->assign('arrParams', '{\'order\':[[4,\'desc\']]}');
    }

    // 表格数据的处理(显示之前的处理)
    public function handleValue(&$arrData, $isAll = true)
    {
        if (false === $isAll) $arrData = array($arrData);

        // 处理显示
        foreach ($arrData as &$mval)
        {
            $mval['create_time'] = date('Y-m-d H:i:s', $mval['create_time']);
            $tmpColor            = $mval['account'] > 0 ? 'green' : 'red';
            $mval['account']     = '<span style="color:'.$tmpColor.'">'.$mval['account'].'</span>';
        }

        if (false === $isAll) $arrData = array_shift($arrData);
    }

    /**
     * beforeUpdate() 修改之前的处理
     * @access protected
     * @param  object $model 模型对象
     * @param  string $str   提示信息
     * @return bool   执行成功返回true
     */
    protected function beforeUpdate($model, &$str)
    {
        // 获取增加还是减少积分
        $isTrue = true;
        if ($model->isNew)
        {
            $str        = '用户ID不存在';
            $intUid     = $model->user_id;          // 用户ID
            $intAccount = abs($model->account);     // 积分
            $intStatus  = post('status');           // 使用情况

            // 判断用户ID是否存在
            $objModel   = M('Users');
            $arrUser    = $objModel->field('id, account')->where(array('id' => $intUid, 'status' => 1))->find();
            $isTrue     = false;
            if ( ! empty($arrUser))
            {
                $str = '修改用户积分信息出现错误';
                if ($intStatus == 1)    // 添加积分
                {
                    $isTrue = $objModel->setInc('account', '`id` = ' . $intUid, $intAccount);
                }
                else                    // 使用积分
                {
                    $str = '用户积分不足,不能进行下一步操作';
                    if ($arrUser['account'] >= $intAccount) $isTrue = $objModel->setDec('account', '`id` = ' . $intUid, $intAccount);
                    $model->account = -$intAccount;
                }
            }
        }

        return $isTrue;
    }
}
?>