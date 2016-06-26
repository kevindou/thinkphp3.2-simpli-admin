<?php
namespace app\modules\admin\controllers;
use app\modules\admin\models as models;
use yii\data\Pagination;
use app\common\Helpers;
use yii\helpers\Url;

class Controller extends \yii\web\Controller
{
    // 定义信息
    protected $title   = '';                // 标题信息

    // 错误提示
    protected $strError = '服务器繁忙,请稍候再试...';
    protected $arrError = array(
        'status' => 0,
        'msg'    => '提交数据错误',
    );

    // 成功提示
    protected $arrSuccess = array(
        'status' => 1,
        'msg'    => '操作成功',
    );

    // 初始化判断用户是否已经登录
    public function init()
    {
        parent::init();
        // 验证用户是否已经登录
        if (empty(\Yii::$app->session->get(\Yii::$app->params['session_admin'])))
        {
            return $this->redirect(\Yii::$app->request->hostInfo.'/admin.html');
        }

        // 注入导航栏信息
        \Yii::$app->view->params['arrMenu'] = $this->searchMenu();
        \Yii::$app->view->params['title']   = $this->title;
    }

    /**
     * actionIndex() 首页显示
     * @return string
     */
    public function actionIndex()
    {
        $model   = $this->getModel();
        $arr     = Helpers::aceTableCol($model->showTableAttributes(), $model->attributeLabels());
        $labels  = $model->attributeLabels();                   // 字段对应的关系

        // 加载模板注入变量
        return $this->render('/layouts/dataTables', [
            'aoColumns'       => $arr['aoColumns'],
            'strSearch'       => $arr['strSearch'],
            'alias'           => $model->getAlias(),            // 别名字段
            'attributes'      => $labels,                       // 表格字段信息
            'form_attributes' => $model->showFormAttributes(),  // 表单字段信息
            'model'           => $this->getModel(),
        ]);
    }

    /**
     * getModel() 获取model对象
     * @return models\Model
     */
    public function getModel()
    {
        return new models\Model;
    }

    public function actionGetData()
    {

        // 接收参数
        $request     = \Yii::$app->request;
        $intSort    = (int)$request->get('iSortCol_0');           // 排序字段
        $strOrder   = $request->get('sSortDir_0');                // 排序类型
        $strOrder   = $strOrder == 'asc' ? SORT_ASC : SORT_DESC; // 排序字段
        $strColumns = $request->get('sColumns');                  // 字段信息
        $strSearch  = $request->get('sSearch');                   // 搜索内容
        $intStart   = (int)$request->get('iDisplayStart', 0);     // 查询其气势启始位置
        $intStart   = empty($intStart) ? 0 : $intStart;
        $intSize    = (int)$request->get('iDisplayLength', 10);   // 查询数据条数
        $intSize    = empty($intSize) ? 10 : $intSize;
        $arrColumns = !empty($strColumns) ? explode(',', $strColumns) : array();
        $strSort    = $arrColumns[$intSort];

        $model = $this->getModel();
        $where = [];

        // 判断是否有模糊快速查询
        if (! empty($strSearch))
        {
            $arrLikes = $model->getLikes();
            foreach ($arrLikes as $value) $where[] = ['like', $value, $strSearch];
        }

        // 其他查询条件
        if ( ! empty($request->get()))
        {
            $arrAttributes = $model->showTableAttributes();
            foreach ($request->get() as $key => $value)
            {
                if ($value === '' || $value == '请选择') continue;   // 为空过滤掉
                $strTmp = stristr($key, 'sSearch_');                // 取出字符串
                if ($strTmp)
                {
                    $intKey  = (int)trim($strTmp, 'sSearch_');     // 获取搜索索引
                    $strKey  = $arrColumns[$intKey];
                    $strType = isset($arrAttributes[$strKey]['search']['and']) ? $arrAttributes[$strKey]['search']['and'] : '=';
                    if ($value == -100) continue;
                    $where[] = [$strType, $strKey, $value];
                }
            }
        }

        if (count($where) > 0) array_unshift($where, 'and');

        // 查询数据的总条数
        $query      = $model->find()->where($where);
        $countQuery = clone $query;
        $intTotal   = $countQuery->count();

        // 查询数据
        $data     = $query->offset($intStart)->limit($intSize)->orderBy([$strSort => $strOrder])->asArray()->all();
//        echo $model->find()->where($where)->offset($intStart)->limit($intSize)->orderBy([$strSort => $strOrder])->createCommand()->getRawSql();

        // 处理显示数据
        if ($data)
            $this->beforeShow($data, $model);
        else
            $data = [];


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'sEcho'                => $request->get('sEcho'),
            'iTotalRecords'        => count($data),
            'iTotalDisplayRecords' => $intTotal,
            'aaData'               => $data,
        ];
    }

    // 查询到的数据显示之前的处理
    public function beforeShow(&$arrData, $model) {return true;}

    /**
     * beforeUpdate() 修改之前的处理
     * @access protected
     * @param  object $model        模型对象
     * @param  string $str          提示信息
     * @param  string $strOperate   操作类型(edit = 编辑;add = 新增)
     * @return bool   执行成功返回true
     */
    protected function beforeUpdate($model, &$str, $strOperate) { return true;}

    // 修改数据和新增数据
    public function actionUpdate()
    {
        // 定义错误信息
        $arrError = $this->arrError;    // 错误信息
        $request  = \Yii::$app->request;
        $data     = $request->post();   // 提交参数

        // 判断参数问题
        if (isset($data['oper']) && !empty($data['oper']) && count($data) > 1)
        {
            $arrError['msg'] = $this->strError;

            // 创建模型对象
            $model  = $this->getModel();

            // 修改和删除数据的判断处理
            if ($data['oper'] === 'edit' || $data['oper'] === 'del') $model = $model->findOne($data['id']);

            if ($data['oper'] === 'del')    // 删除
                $isTrue = $model->delete();
            else                            // 添加和修改
            {
                $isTrue = $model->load(['formName' => $data], 'formName');

                if ($isTrue)
                {
                    // 验证成功修改之前的处理
                    if ($this->beforeUpdate($model, $arrError['msg'], $data['oper']))
                    {
                        $isTrue = $model->save();
                        $arrError['msg'] = $model->getError();
                    }
                }
            }

            // 判断操作的结果返回
            if ($isTrue) $arrError = $this->arrSuccess;
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $arrError;
    }

    // searchMenu() 查询导航栏信息
    public function searchMenu()
    {
        $duration = 60 * 60 * 12;
        $cache    = \Yii::$app->cache;
        $arrMenu  = $cache->get('arrMenu');
        if ($arrMenu == false)
        {
            // 查询到导航栏目
            $arrMenu = models\Menu::find()
                ->select(['id', 'menu_name', 'parent_id', 'icons', 'controller_name', 'action_name'])
                ->where(['status' => 1])
                ->orderBy(['sort' => 'ASC'])
                ->all();

            // 存入缓存
            $cache->set('arrMenu', $arrMenu, $duration);
        }


        // 处理数据
        $arrOneMenu = $arrTwoMenu = $arrThreeMenu = array();
        if ($arrMenu) {
            // 获取第一级分类
            foreach ($arrMenu as $key => $value) {
                if (empty($value->parent_id)) {
                    $arrOneMenu[$value->id] = [
                        'id' => $value->id,
                        'menu_name' => $value->menu_name,
                        'parent_id' => $value->parent_id,
                        'icons' => $value->icons,
                        'controller_name' => $value->controller_name,
                        'action_name' => $value->action_name,
                    ];
                    unset($arrMenu[$key]);
                }
            }

            // 获取第二级分类
            foreach ($arrMenu as $key => $value) {
                $strKey = $value->parent_id;
                $intId = $value->id;
                if (isset($arrOneMenu[$strKey])) {
                    $arrOneMenu[$strKey]['child'][$intId] = $arrTwoMenu[$intId] = [
                        'id' => $value->id,
                        'menu_name' => $value->menu_name,
                        'parent_id' => $value->parent_id,
                        'icons' => $value->icons,
                        'controller_name' => $value->controller_name,
                        'action_name' => $value->action_name,
                    ];;
                    unset($arrMenu[$key]);
                }
            }

            // 获取第三级分类
            foreach ($arrMenu as $key => $value) {
                $strKey = $value['parent_id'];
                if (isset($arrTwoMenu[$strKey])) $arrThreeMenu[$strKey][] = [
                    'id' => $value->id,
                    'menu_name' => $value->menu_name,
                    'parent_id' => $value->parent_id,
                    'icons' => $value->icons,
                    'controller_name' => $value->controller_name,
                    'action_name' => $value->action_name,
                ];
            }

            // 组合
            foreach ($arrOneMenu as $key => &$value) {
                if (isset($value['child']) && !empty($value['child'])) {
                    foreach ($value['child'] as &$val) $val['child'] = isset($arrThreeMenu[$val['id']]) ? $arrThreeMenu[$val['id']] : [];
                }
            }

            // 清楚多余信息
            $arrMenu = $arrOneMenu;
            unset($arrTwoMenu);
            unset($arrThreeMenu);
            unset($arrOneMenu);
        }

        return $arrMenu;
    }
}
