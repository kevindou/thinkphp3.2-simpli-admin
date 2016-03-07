<?php
/**
 * Class IndexAction
 * Desc: 后台用户登录页面
 * User: liujx
 * Date: 2015-11-30
 */
class ArticleAction extends CommAction
{
    // 初始化定义
    public $title = '文章信息';
    public $model = 'Article';

    public $arrButton = array(
        'submit' => array('class' => 'btn-primary', 'name' => '提交', 'other' => array('id' => 'updateSub')),
        'reset'  => array('name' => '重置'),
    );

    // 显示之前执行
    public function beforeIndex($model)
    {
        // 模型字段默认赋值
        $model->arrAddTh['status']['value']    = $this->arrStatus;
        $model->arrAddTh['recommend']['value'] = $model->arrShowTh[6]['search']['value'] = $this->arrRecommend;
        $model->arrAddTh['cateId']['value']    = $model->arrShowTh[1]['search']['value'] = D('Category')->where('`pid` != 0')->findAll(array(
            'index'  => 'id',       // 索引
            'keyval' => 'cateName'  // 值
        ));

        // 显示表单提交按钮
        $this->arrTopOperate['plus']['other']  = array('id' => 'addOther');    // 重定义按钮
    }

    // 分配主要显示内容
    public function allotFluidContent($model)
    {

        // 之前的处理
        $arrAllot     = parent::allotFluidContent($model);
        $arrThOperate = $this->arrTopOperate;
        array_shift($arrThOperate);
        $arrAllot[2]  = array(
            'title'       => '编辑'. $this->title,
            'topOperate'  =>  $this->showOperate($arrThOperate),
            'isShowTable' => false,
            'class'       => 'isHide',
        );
        $arrAllot[2]['content']['addDiv'] = $arrAllot[0]['content']['addDiv'];
        $arrAllot[2]['content']['addDiv']['class'] = '';
        unset($arrAllot[0]['content']);

        // 返回显示数据
        return $arrAllot;
    }

    // 表格数据的处理(显示之前的处理)
    public function handleValue(&$arrData, $isAll = true)
    {
        if (false === $isAll) $arrData = array($arrData);

        $arrAids = array();
        foreach ($arrData as $val) $arrAids[] = $val['cateId'];
        // 查询数据
        $arrAgents = D('Category')->where()->findAll(array(
            'index'  => 'id',
            'keyval' => 'cateName',
            'id'     => array('in' => array_unique($arrAids))
        ));

        array_unshift($arrAgents, '顶级分类');

        // 处理显示
        foreach ($arrData as &$mval)
        {
            $mval['createTime'] = date('Y-m-d H:i:s', $mval['createTime']);
            $mval['updateTime'] = date('Y-m-d H:i:s', $mval['updateTime']);
            $mval['status']     = $this->showStatus($mval['status'], $this->arrStatus, $this->arrColor);
            $mval['cateId']     = $arrAgents[$mval['cateId']];
            $mval['recommend']  = $this->showStatus($mval['recommend'], $this->arrRecommend, $this->arrRcolor);
        }

        if (false === $isAll) $arrData = array_shift($arrData);
    }
}