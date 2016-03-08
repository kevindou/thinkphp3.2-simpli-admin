<?php
/**
 * Class IndexAction
 * Desc: 后台用户登录页面
 * User: liujx
 * Date: 2015-11-30
 */
class AgentAction extends CommAction
{
    // 初始化定义
    public $title = '平台信息列表';
    public $model = 'Agent';
    public $strPk = 'unique';

    // 显示之前执行
    public function beforeIndex($model)
    {
        $model->arrAddTh['recharge_status']['value'] = $model->arrAddTh['status']['value']      = $model->arrShowTh[7]['search']['value']    = $this->arrStatus;
        $model->arrEditTh                        = $model->arrAddTh;
        $model->arrEditTh['unique']              = array('type' => 'hidden');
    }

    // 表格数据的处理(显示之前的处理)
    public function handleValue(&$arrData, $isAll = true)
    {
        if (false === $isAll) $arrData = array($arrData);

        // 处理显示
        foreach ($arrData as &$mval)
        {
            $mval['createTime']      = date('Y-m-d H:i:s', $mval['createTime']);
            $mval['updateTime']      = date('Y-m-d H:i:s', $mval['updateTime']);
            $mval['status']          = $this->showStatus($mval['status'], $this->arrStatus, $this->arrColor);
            $mval['recharge_status'] = $this->showStatus($mval['recharge_status'], $this->arrStatus, $this->arrColor);
        }

        if (false === $isAll) $arrData = array_shift($arrData);
    }

    // 修改数据之前
    public function beforeUpdate($model, &$str)
    {
        $model->isNew = isset($model->unique) && ! empty($model->unique) ? false : true;
        return true;
    }
}
?>