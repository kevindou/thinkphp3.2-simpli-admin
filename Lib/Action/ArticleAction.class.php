<?php

/**
 * Class ArticleAction
 * Desc: 新闻信息公告控制器
 * User: liujx
 * Date: 2015-12-23
 */

class ArticleAction extends CommonAction
{
    // 首页显示
	public function index()
	{
        import("ORG.Util.Page");                                            // 导入分页类
        // 处理分类信息
        $intPid   = (int)get('pid', 1);                                     // 获取分类ID,默认新闻公告
        $objModel = D('project_category');                                  // 模型对象
        $arrCate  = $objModel->field('id, pid, cateName')->find($intPid);   // 自己的信息
        $arrChild = $arrArticle = array();                                  // 初始化定义
        $strPage  = '';                                                     // 分页信息

        // 判断数据有效
        if ($arrCate)
        {
            // 确定父类ID
            $intParentId = $arrCate['pid'] == 0 ? $arrCate['id'] : $arrCate['pid'];
            // 查询全部子类信息
            $arrChild    = $objModel->where(array('pid' => $intParentId))->findAll();

            // 查询文章信息
            $arrWhere = array('cateId' => $arrCate['id'], 'status' => 1);
            if ($arrCate['pid'] == 0 && ! empty($arrChild))
            {
                $arrTmpId = array();
                foreach ($arrChild as $value) $arrTmpId[] = $value['id'];
                $arrWhere = '`cateId` IN ('.implode(',', $arrTmpId).') AND `status` = 1';
            }

            // 查询数据总条数
            $objArticle = D('project_article');
            $intCount   = $objArticle->where($arrWhere)->count();
            $objPage    = new Page($intCount, 25);

            // 分页配置信息
            $objPage->config = array(
                'header' => '条记录',
                'prev'   => '上一页',
                'next'   => '下一页',
                'first'  => '首页',
                'last'   => '尾页',
                'theme'  => '%first% %upPage% %linkPage% %prePage% %downPage% %end% %nextPage% %totalRow% %header% %nowPage%/%totalPage% 页',
            );

            $strPage    = $objPage->show();
            $strLimit   = $objPage->firstRow.','.$objPage->listRows;
            $arrArticle = $objArticle->field('id, cateId, title, createTime')->where($arrWhere)->order('sort DESC')->limit($strLimit)->findAll();

            $arrCate     = array($arrCate);
            // 子类需要加入父类的面包屑信息
            if ($arrCate[0]['pid'] != 0)
            {
                $arrTmp = $objModel->field('id, cateName')->where(array('id' => $arrCate[0]['pid']))->find();
                if ($arrTmp) array_unshift($arrCate, $arrTmp);
            }
        }

        // 注入变量
        $this->assign(array(
            'intPid'     => $intPid,        // 分类ID
            'arrCate'    => $arrCate,       // 面包屑信息
            'arrChild'   => $arrChild,      // 所有子类或同级别类信息
            'arrArticle' => $arrArticle,    // 所有文章信息
            'strPage'    => $strPage,       // 分页信息
        ));
		$this->display('index');            // 载入模板
	}

    // 详情页面显示
    public function detail()
    {
        // 接收参数信息
        $intPid  = (int)get('pid');       // 分类信息
        $intId   = (int)get('id');        // 文章ID

        // 初始化定义信息
        $arrCate = $arrArticle = $arrPrev = $arrNext = $arrRecommend = array();
        if ($intPid && $intId)
        {
            // 初始化模型对象
            $objCate  = D('project_category'); // 分类
            $objModel = D('project_article');  // 文章

            // 查询面包屑信息
            $arrTmp  = $objCate->field('id, pid, cateName')->find($intPid);    // 分类ID
            $arrCate = array($arrTmp);
            if (! empty($arrTmp) && $arrTmp['pid'] != 0)
            {
                $arrTmp = $objCate->field('id, cateName')->where(array('id' => $arrTmp['pid']))->find();
                if ($arrTmp) array_unshift($arrCate, $arrTmp);
            }

            // 查询文章信息
            $arrArticle = $objModel->find($intId);
            if ($arrArticle)
            {
                $strAnd   = ' < ';
                $strWhere = '`cateId` = '.(int)$arrArticle['cateId'] .' AND `status` = 1  AND `id`';
                $arrPrev  = $objModel->field('id, cateId, title')->where($strWhere.$strAnd.$intId)->order('`id` DESC')->find();
                $strAnd   = ' > ';
                $arrNext  = $objModel->field('id, cateId, title')->where($strWhere.$strAnd.$intId)->order('`id` ASC')->find();
            }

            // 查询推荐信息
            $arrRecommend = $objModel->where(array('pid' => $intPid, 'recommend' => 1))->order('createTime DESC')->limit(10)->findAll();
        }

        // 注入变量信息
        $this->assign(array(
            'arrCate'      => $arrCate,       // 面包屑信息
            'arrArticle'   => $arrArticle,    // 文章信息
            'arrPrev'      => $arrPrev,       // 上一骗
            'arrNext'      => $arrNext,       // 下一篇
            'arrRecommend' => $arrRecommend,  // 推荐
        ));
        $this->display('detail');
    }

    // 领新手卡
    public function newCard()
    {
        $this->display('newCard');
    }
}
?>