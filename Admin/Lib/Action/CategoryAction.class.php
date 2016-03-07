<?php
/**
 * Class CategoryAction
 * Desc: 后台文章分类列表
 * User: liujx
 * Date: 2015-11-30
 */
class CategoryAction extends CommAction
{
    // 初始化定义
    public $title = '文章分类';
    public $model = 'Category';

    // 显示之前执行
    public function beforeIndex($model)
    {
        $model->arrAddTh['status']['value'] = $model->arrShowTh[4]['search']['value'] = $this->arrStatus;
        $arrCate = array(0 => '顶级分类');
        $arrTmp  = $model->arrShowTh[1]['search']['value'] = D('Category')->where(array('pid' => 0))->findAll(array('index' => 'id', 'keyval' => 'cateName'));
        if ($arrTmp) $arrCate = array_merge($arrCate, $arrTmp);
        $model->arrAddTh['pid']['value']    = $arrCate;
        $model->arrAddTh['recommend']['value'] = $model->arrShowTh[5]['search']['value'] = $this->arrRecommend;
        $model->arrEditTh = $model->arrAddTh;
        $model->arrEditTh['id'] = array('type' => 'hidden');
    }

    // 表格数据的处理(显示之前的处理)
    public function handleValue(&$arrData, $isAll = true)
    {
        if (false === $isAll) $arrData = array($arrData);

        $arrAids = array();
        foreach ($arrData as $val) $arrAids[] = $val['pid'];
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
            $mval['recommend']  = $this->showStatus($mval['recommend'], $this->arrRecommend, $this->arrRcolor);
            $mval['pid']        = $arrAgents[$mval['pid']];
        }

        if (false === $isAll) $arrData = array_shift($arrData);
    }
}
?>