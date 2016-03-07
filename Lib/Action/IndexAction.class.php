<?php
/**
 * Class IndexAction
 * Desc: 首页控制器
 * user: liujx
 * date: 2015-12-17
 */
class IndexAction extends CommonAction
{
    public $sort = array('sort' => 'ASC');
	// 首页显示
    public function index()
	{
		// 开始查询数据信息
        $objModel  = M('project_article');

        // 查询游戏攻略信息
        $arrStrategy = $objModel->field('id,cateId,title')->where(array(
            'status'    => 1,
            'recommend' => 1,
            'cateId'    => 11))->order($this->sort)->limit(7)->findAll();

        $objCategory  = M('project_category');

        // 查询游戏新闻信息
        $cateGory = $this->getCateArticle($objCategory, $objModel, 1, 5, 5);

        // 查询游戏资料信息
        $gameData = $this->getCateArticle($objCategory, $objModel, 2, 4, 9);

        // 注入查询信息
        $this->assign(array(
            'activity' => $cateGory,        // 活动信息
            'gamedata' => $gameData,        // 游戏资料
            'strategy' => $arrStrategy,     // 游戏攻略信息
        ));

        // 载入模板
        $this->display('index');
    }

    public function error()
    {
        parent::error('您好！我们的新平台已经迁移了哦！正在为您跳转到新官网...');
    }

	// 验证码
	public function verify()
	{
		import("ORG.Util.Image");
		Image::buildImageVerify(5, 1, 'png', 50, 30);
	}

    // 根据分类查询下面的数据
    protected function getCateArticle($objCate, $objArtice, $intPid, $intC, $intA)
    {
        $arrData         = array();
        $where           = $arrWhere = array('status' => 1, 'recommend' => 1);
        $arrWhere['pid'] = $intPid;
        $arrCate         = $objCate->where($arrWhere)->order($this->sort)->limit($intC)->findAll();
        if ($arrCate)
        {
            foreach ($arrCate as $value)
            {
                $where['cateId'] = $value['id'];
                $arrData[] = array(
                    'cateName' => $value['cateName'],
                    'article'  => $objArtice->field('id,cateId,title,createTime')->where($where)->order($this->sort)->limit($intA)->findAll(),
                );
            }
        }

        return $arrData;
    }
}
?>