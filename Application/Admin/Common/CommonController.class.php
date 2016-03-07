<?php
/**
 * file: CommAction.class.php
 * desc: 公共的控制器(用户必须登录)
 * user: liujx
 * date: 2015-11-30
 */
namespace Admin\Common;
use Think\Controller;
use Common\CHtml;

class CommonController extends Controller
{
    // 定义按钮
    public $arrButton  = array();
    // 定义显示方式 ( dataTables or jqGrid ) 默认dataTables
    public $strShowWay = 'dataTables';

    // 定义信息
    protected $session = 'my_blog_admin';   // SESSION名称
    protected $model   = '';                // MODEL名称
    protected $title   = '死神WEB管理后台';  // 标题信息

    // 错误提示
    protected $strError = '服务器出现错误,请稍候再试...';
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
    public function __construct()
    {
        parent::__construct();
        // 验证用户是否已经登录
        $admin = session($this->session);
        if (empty($admin) || empty($admin['id'])) $this->redirect('Index/index');
    }

    // 首页
    public function index()
    {
        // 公共部分
        $this->searchMenu();                    // 注入导航信息
        $this->assign('title', $this->title);   // 标题信息
        $model = D($this->model);

        // 根据显示方式处理数据
        if ($this->strShowWay == 'dataTables')
        {
            $this->assign(array(
                // 编辑表单
                'addForm'    => CHtml::aceForm($model->showFormAttributes(), array(
                    'action'     => ACTION_NAME.'/update.html',
                    'mother'     => 'post',
                    'novalidate' => 'novalidate',
                    'name'       => 'update-form',
                    'class'      => 'form-horizontal update-form is-hide',
                    'role'       => 'form',
                )),
                // 详情信息
                'dataInfo' => CHtml::aceTableInfo($model->attribute, array('class' => 'data-info is-hide'))
            ));

            // 注入表格列信息和搜索信息
            $this->assign(CHtml::aceTableCol($model->showTableAttributes()));
            $this->display('Layout:dataTables');
        }
        else
        {
            // 注入 jqGrid 需要信息
            $this->assign(CHtml::setColModel($model->showColModel(), $model->attribute));
            $this->display('Layout:jqGrid');
        }
    }

    /**
     * beforeSearch() 搜索之前的处理处理
     * @access public
     * @param  object $model 查询的模型
     */
    public function beforeSearch($model)
    {
        // 定义返回数据
        $arrReturn  = array(
            'sort'  => 'id ASC',
            'where' => array(),
            'limit' => '0, 10',
            'total' => 0,
        );

        // dataTables
        if ($this->strShowWay == 'dataTables')
        {
            // 接收参数
            $intSort    = (int)get('iSortCol_0');           // 排序字段
            $strOrder   = get('sSortDir_0');                // 排序类型
            $strColumns = get('sColumns');                  // 字段信息
            $strSearch  = get('sSearch');                   // 搜索内容
            $intStart   = (int)get('iDisplayStart', 0);     // 查询其气势启始位置
            $intSize    = (int)get('iDisplayLength', 10);   // 查询数据条数
            $arrColumns = !empty($strColumns) ? explode(',', $strColumns) : array();
            $strSort    = $arrColumns[$intSort];

            // 处理查询
            if (! empty($strSearch))
            {
                $arrSearch = explode(',', $model->strLike);
                foreach ($arrSearch as &$value) $value = '`'.$value .'` LIKE \'%'.$strSearch.'%\'';
                $arrReturn['where'][] = '(' . implode(' OR ', $arrSearch) . ')';
            }

            if ( ! empty($_GET))
            {
                $arrAttributes = $model->showTableAttributes();
                foreach ($_GET as $key => $value)
                {
                    if ($value === '' || $value == '请选择') continue;   // 为空过滤掉
                    $strTmp = stristr($key, 'sSearch_');                // 取出字符串
                    if ($strTmp)
                    {
                        $intKey = (int)trim($strTmp, 'sSearch_');       // 获取搜索索引
                        $strKey = $arrColumns[$intKey];
                        $strAnd = isset($arrAttributes[$strKey]['search']['and']) ? $arrAttributes[$strKey]['search']['and'] : '=';
                        if ($strAnd === 'LIKE') $value = '%'.$value.'%';
                        $arrReturn['where'][] = "(`{$strKey}` {$strAnd} '{$value}')";
                    }
                }
            }

            // 处理查询条件
            $arrReturn['where'] = implode(' AND ', $arrReturn['where']);
        }
        else    // 处理jqGrid
        {
            // 获取参数
            $intRows  = get('rows', 10);    // 每页数量
            $strSort  = get('sidx', 'id');  // 排序字段
            $strOrder = get('sord');        // 排序方式
            $filters  = get('filters');     // 查询字段信息
            $isSearch = get('_search');     // 是否查询
            if (! empty($filters) && ! empty($isSearch))
            {
                $arrSearch = json_decode($filters, true);
                if (! empty($arrSearch['rules']))
                {
                    $where = array();
                    foreach ($arrSearch['rules'] as $strValue)
                    {
                        // 判断类型
                        switch ($strValue['op'])
                        {
                            case 'eq' : $and = '=';        break;  // 等于
                            case 'ne' : $and = '!=';       break;  // 不等于
                            case 'bw' : $and = '>';        break;  // 开始于
                            case 'bn' : $and = '<=';       break;  // 不开始于
                            case 'ew' : $and = '<';        break;  // 结束于
                            case 'en' : $and = '>=';       break;  // 不结束于
                            case 'cn' : $and = 'LIKE \'%'.$strValue['data'].'%\'';                        break;  // 包含
                            case 'nc' : $and = 'NOT LIKE \'%'.$strValue['data'].'%\'';                    break;  // 不包含
                            case 'nu' : $and = 'IS NULL';                                                 break;  // 不存在
                            case 'nn' : $and = 'IS NOT NULL';                                             break;  // 存在
                            case 'in' : $and = 'IN ('.implode(',', trim($strValue['data']), ',').')';     break;  // 属于
                            case 'ni' : $and = 'NOT IN ('.implode(',', trim($strValue['data']), ',').')'; break;  // 不属于
                            default:    $and = '=';        break;  // 默认等于
                        }

                        $strField = '`'.trim(trim($strValue['field']), '`').'`';

                        // 添加查询条件
                        if (in_array($strValue['op'], array('cn', 'nc', 'nu', 'nn', 'in', 'ni')))
                            $where[] = $strField.' '. $and;
                        else
                        {
                            $strValue['data'] = trim($strValue['data']);
                            $maxVal           = is_numeric($strValue['data']) ? $strValue['data'] : '\''.$strValue['data'].'\'';
                            $where[]          = $strField.' '.$and.' '.$maxVal;
                        }
                    }

                    $arrReturn['where'] = implode(' '.trim($arrSearch['groupOp']).' ', $where);
                }
            }
        }

        // 查询数据总条数
        $arrReturn['total'] = $intTotal = $model->where($arrReturn['where'])->count();  // 数据条数】
        // jqGrid 处理分页
        if ($this->strShowWay == 'jqGrid')
        {
            $objPage  = new \Think\Page($intTotal, $intRows);         // 处理分页
            $objPage->show();
            $intStart = $objPage->firstRow;
            $intSize  = $objPage->listRows;
        }

        // 处理查询条数
        $arrReturn['limit'] = $intStart . ', '.$intSize;
        // 处理排序
        if ($strOrder) $arrReturn['sort'] = $strSort.' '.$strOrder;

        return $arrReturn;
    }

    // 查询到的数据显示之前的处理
    public function beforeShow(&$arrData, $model) {return true;}

    // 获取数据
    public function getData()
    {
        // 开始处理查询
        $model     = D($this->model);                               // 创建对戏模型
        $arrSearch = $this->beforeSearch($model);                   // 查询参数信息
        // 分页查询
        $data      = $model->where($arrSearch['where'])->order($arrSearch['sort'])->limit($arrSearch['limit'])->select();
        if ($data)
        {
            // 处理值
            $this->beforeShow($data, $model);
        }
        else
            $data = array();

        if ($this->strShowWay == 'dataTables')
        {
            $arrJson = array(
                'sEcho'                => get('sEcho'),
                'iTotalRecords'        => count($data),
                'iTotalDisplayRecords' => $arrSearch['total'],
                'aaData'               => $data,
            );
        }
        else
        {
            $arrJson = array(
                'rows'    => $data,                  // 数据信息
                'total'   => $arrSearch['total'],    // 总数据数
                'page'    => get('page'),            // 当前页
                'records' => count($data),           // 查询数据条数
            );
        }

        // 返回数据
        $this->ajaxReturn($arrJson);
    }

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
    public function update()
    {
        $strOperate = post('oper');       // 操作类型
        $model      = D($this->model);    // 模型对象
        $arrError   = $this->arrError;    // 错误信息

        // 判断提交数据的有效性
        if ($strOperate && isset($_POST) &&  empty($_POST))
        {
            $arrError['msg'] = $this->strError;
            // 数据删除
            if ($strOperate == 'del')
                $isTrue = $model->delete(post($model->getPk()));
            else
            {
                // 数据的创建和自动验证
                $isTrue          = $model->create();
                $arrError['msg'] = $model->getError();
                if ($isTrue)
                {
                    // 验证成功修改之前的处理
                    if ($this->beforeUpdate($model, $arrError['msg'], $strOperate))
                    {
                        $arrError['msg'] = $this->strError;

                        // 判断编辑和新增
                        if ($strOperate == 'edit')
                            $isTrue = $model->save();
                        else
                            $isTrue = $model->add();
                    }
                }
            }

            // 判断操作是否成功
            if ($isTrue) $arrError = $this->arrSuccess;
        }

        $this->ajaxReturn($arrError);
    }

    // 获取数据的详情
    public function getDetail()
    {
        $data = D($this->model)->find(get('id'));
        if (empty($data)) $data = array();
        $this->ajaxReturn($data);
    }


    // searchMenu() 查询导航栏信息
    public function searchMenu()
    {
        // 查询导航栏信息
        $objModel = D('Menu');

        // 查询导航栏信息
        $arrMenu = $objModel->field('id, menu_name, parent_id, icons, controller_name, action_name')->where(array('status' => 1))->order(array('sort' => 'ASC'))->select();

        // 处理数据
        $arrOneMenu = $arrTwoMenu = $arrThreeMenu = array();
        if ($arrMenu)
        {
            // 获取第一级分类
            foreach ($arrMenu as $key => $value)
            {
                if (empty($value['parent_id']))
                {
                    $arrOneMenu[$value['id']] = $value;
                    unset($arrMenu[$key]);
                }
            }

            // 获取第二级分类
            foreach ($arrMenu as $key => $value)
            {
                $strKey = $value['parent_id'];
                $intId  = $value['id'];
                if (isset($arrOneMenu[$strKey]))
                {
                    $arrOneMenu[$strKey]['child'][$intId] = $arrTwoMenu[$intId] = $value;
                    unset($arrMenu[$key]);
                }
            }

            // 获取第三级分类
            foreach ($arrMenu as $key => $value)
            {
                $strKey = $value['parent_id'];
                if (isset($arrTwoMenu[$strKey]))$arrThreeMenu[$strKey][] = $value;
            }

            // 组合
            foreach ($arrOneMenu as $key => &$value)
            {
                if (isset($value['child']) && ! empty($value['child']))
                {
                    foreach ($value['child'] as &$val)$val['child'] = $arrThreeMenu[$val['id']];
                }
            }

            // 清楚多余信息
            $arrMenu = $arrOneMenu;
            unset($arrTwoMenu);
            unset($arrThreeMenu);
            unset($arrOneMenu);
        }

        $this->assign('menu', $arrMenu);    // 注入导航信息
    }
}