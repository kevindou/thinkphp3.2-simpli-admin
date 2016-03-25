<?php
/**
 * file: CommAction.class.php
 * desc: 公共的控制器(用户必须登录)
 * user: liujx
 * date: 2015-11-30
 */

class CommAction extends Action
{
    // 初始化显示信息
    public $arrRecommend = array('不推荐', '推荐');              // 推荐信息
    public $arrStatus    = array(1 => '启用', 0 => '停用' );     // 状态信息
    public $arrColor     = array('important', 'success');       // 状态显示颜色
    public $arrRcolor    = array('warning', 'success');         // 推荐显示颜色
    public $isOperate    = true;                                // 是否需要按钮
    public $strPk        = 'id';                                // 模型的主键字段

    // 定义按钮信息(标题按钮)
    public $arrTopOperate = array(
        'plus'       => array('title' => '添加', 'other' => array('id' => 'addData')),
        'refresh'    => array('title' => '刷新', 'other' => array('id' => 'table-refresh')),
        'fullscreen' => array('title' => '全屏', 'other' => array('class' => 'hidden-phone hidden-tablet', 'id' => 'toggle-fullscreen')),
        'chevron-up' => array('title' => '隐藏', 'other' => array('class' => 'btn-minimize')),
        'remove'     => array('title' => '删除', 'other' => array('class' => 'btn-close')),
    );

    // 定义操作按钮(表格中的数据)
    public $arrOperateButton = array(
        'zoom-in' => array('title' => '查看', 'other' => array('class' => 'btn btn-success')),
        'edit'    => array('title' => '修改', 'other' => array('class' => 'btn btn-info btn-edit')),
        'trash'   => array('title' => '删除', 'other' => array('class' => 'btn btn-danger btn-delete')),
    );

    // 定义按钮
    public $arrButton = array();

    // 定义信息
    protected $session = 'gt_adminuser';    // SESSION名称
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

    // 排序
    protected $strSort  = 'id ASC';
    protected $arrWhere = '';

    // 初始化判断用户是否已经登录
    public function __construct()
    {
        parent::__construct();
        // 验证用户是否已经登录
        if (! isset($_SESSION[$this->session]) || empty($_SESSION[$this->session]))
        {
            session_destroy();
            header('Location:/admin.php');
            exit;
        }
    }

    /**
     * showOperate() 显示按钮信息
     * @param  array  $arrOperate 显示的按钮
     * @param  array  $arrHide    需要隐藏的按钮
     * @return string 返回字符串
     */
    protected function showOperate($arrOperate, $arrHide = array())
    {
        $strHtml = '';
        if ($arrOperate)
        {
            foreach ($arrOperate as $key => $value)
            {
                if (in_array($key, $arrHide)) continue;
                // 处理其他信息
                $other   = $this->handleOther($value);
                $strHtml .= '<a href="#" title="'.$value['title'].'" '.$other.'> <i class="icon-'.$key.'"></i></a>'."\n\t";
            }
        }

        return $strHtml;
    }

    /**
     * handleOther() 处理其他信息
     * @access protected
     * @param  array  $arrValue 需要处理的数组
     * @return string 返回字符串
     */
    protected function handleOther($arrValue)
    {
        $strHtml = '';
        if (isset($arrValue['other']) && ! empty($arrValue['other']))
        {
            foreach ($arrValue['other'] as $key => $value) $strHtml .= " {$key}=\"{$value}\" ";
        }

        return $strHtml;
    }

    /**
     * showForm() 显示表单数据
     * @access  public
     * @param   array  $arrData     显示的数据
     * @param   string $strName     显示表单名称
     * @param   array  $arrButton   显示的提交按钮
     * @return  string 返回字符串
     */
    public function showForm($arrData, $strName = 'addForm', $arrButton = array())
    {
        if (empty($arrButton)) $arrButton = $this->arrButton;
        $strAction = '/?m='.$this->model.'&a=update';
        $content = '';
        foreach ($arrData as $key => $value)
        {
            $content .= '<div class="control-group">'."\n\t";
            if ($value['type'] != 'hidden')
            {
                $content .= "\t".'<label class="control-label">'.$value['label'].'</label>'."\n\t";
                $content .= "\t".'<div class="controls">'."\n\t";
            }

            // 处理数据 - 其他信息
            $other = $this->handleOther($value);

            // 处理数据 - 表单字段名称
            $name = 'name="'.$key.'"';
            if (!isset($value['value'])) $value['value'] = ''; // 默认赋值
            switch ($value['type'])
            {
                case 'password':
                    $content .= "\t\t".'<input  class="input-xlarge focused" type="password" '.$name.' '.$other.' value="'.$value['value'].'" />';
                    break;
                // 文本字段
                case 'select':
                    $content .= "<select {$name} {$other}>";
                    $selected = isset($value['selected']) ? $value['selected'] : '';
                    $content .= '<option value=""> 请选择 </option>';
                    foreach ($value['value'] as $selkey => $selval)
                    {
                        $isSelect = $selval == $selected ? 'selected="selected"' : '';
                        $content .= "<option value=\"{$selkey}\" {$isSelect}>{$selval}</option>";
                    }

                    $content .= '</select>';
                    break;
                case 'radio' :
                    $checked = isset($value['checked']) ? $value['checked'] : '';
                    foreach ($value['value'] as $radkey => $radval)
                    {
                        $isCheck  =  $radkey == $checked ? 'checked="checked"' : '';
                        $content .= '<label><input type="radio" '.$name.' '.$other. ' '.$isCheck.' value="'.$radkey.'" /> '. $radval .'</label>'."\n\t";
                    }
                    break;

                case 'textarea':
                    $content .= "<textarea {$name} {$other}>{$value['value']}</textarea>";
                    break;
                case 'hidden':
                    $content .= '<input type="hidden" '.$name.' '.$other.' />';
                    break;
                case 'file':
                    $content .= '<input type="hidden" '.$name.' /><input type="file" '.$other.' />';
                    break;
                default :
                    $content .= '<input  class="input-xlarge focused" type="text" '.$name.' '.$other.' value="'.$value['value'].'" />';
                    break;
            }

            if ($value['type'] != 'hidden') $content .= '</div>'."\n\t";;
            $content .= '</div>'."\n\t";;
        }

        $content .= "<label class=\"{$strName}_error m_error error\" style=\"display:none\">服务器繁忙,请稍候再试...</label>";

        // 判断添加按钮
        if (!empty($arrButton))
        {
            $content .= "<div class=\"form-actions\">\n\t";
            foreach ($arrButton as $key => $value)
            {
                $strOther = $this->handleOther($value);
                $strClass = isset($value['class']) ? $value['class'] : '';
                $content .= "<button class=\"btn {$strClass}\" type=\"{$key}\" {$strOther}>{$value['name']}</button> \n\t";
            }

            $content .= "</div>\n\t";
        }

        $html =  <<<Html
            <form class="form-horizontal" id="{$strName}" name="{$strName}" action="/admin.php{$strAction}" method="post">
                <fieldset>
                    {$content}
                </fieldset>
            </form>
Html;
        return $html;
    }

    // 分配主要显示内容
    public function allotFluidContent($model)
    {
        $arrTopOperate = $this->arrTopOperate;
        array_shift($arrTopOperate);
        return array(
            // 主要显示信息
            array(
                'title'       => $this->title,                               // 标题
                'topOperate'  => $this->showOperate($this->arrTopOperate),   // 表头按钮
                'isShowTable' => true,                                       // 表格是否显示
                'class'       => '',                                         // 添加样式
                // 其他内容
                'content'     => array(
                    'addDiv'  => array(
                        'class'   => 'isHide',
                        'content' => $this->showForm($model->arrAddTh, 'addForm')
                    ),   // 添加表单
                    'editDiv' => array(
                        'class'   => 'isHide',
                        'content' => $this->showForm($model->arrEditTh, 'editForm')
                    ), // 修改表单
                ),
            ),

            // 详情信息
            array(
                'title'       => $this->title . '详情',
                'topOperate'  => $this->showOperate($arrTopOperate),
                'isShowTable' => false,
                'class'       => 'isHide',
                'content'     => array(
                    'detailDiv' => array(
                        'class'   => '',
                        'content' => $this->showTable($model->attribute),
                    ),
                ),
            )

        );
    }

    /**
     * tableField() 显示表格字段信息
     * @access public
     * @param  mixed $model 可以是一个 model 对象也可以是一个数组
     * @return array 返回数组
     */
    public function tableField($model)
    {
        $aoColnmns = array();
        $strSearch = '';
        $arrData   = is_object($model) ? $model->arrShowTh : $model;
        foreach ($arrData as  $key => $value)
        {
            // 处理搜索内容
            if (isset($value['search']) && ! empty($value['search']))
            {
                $tmoClass  = isset($value['search']['class']) ? $value['search']['class'] : '';
                if (isset($value['search']['class'])) unset($value['search']['class']);
                $strName   = ' name="'.$value['name'].'" vid="'.$key.'" class="msearch '.$tmoClass.'" ';
                $strOther  = $this->handleOther($value['search']);
                $strSearch .= "<label> {$value['title']} : " ;
                switch ($value['search']['type'])
                {
                    case 'select':
                        $strSearch .= "<select {$strName} {$strOther} ><option value=\"\"> 全部 </option>";
                        foreach ($value['search']['value'] as $strK => $strVal)$strSearch .= "<option value=\"{$strK}\">{$strVal}</option>";
                        $strSearch .= "</select>";
                        break;
                    default:
                        $strSearch .= "<input type=\"text\" {$strName} {$strOther} />";
                        break;
                }

                $strSearch .= "</label>";
            }

            // 默认赋值
            $aoColnmns[] = array(
                'mDataProp' => isset($value['mDataProp']) ? $value['mDataProp'] : $value['name'],
                'sName'     => $value['name'],
                'sTitle'    => $value['title'],
                'bSortable' => isset($value['sort']) ? true : false,
            );
        }

        // 判断添加操作一列
        if ($this->isOperate) $aoColnmns[] = array(
            'mDataProp' => 'operate',
            'sName'     => 'operate',
            'sTitle'    => '操作',
            'bSortable' => false
        );

        // 返回数据
        return array(
            'strSearch' => $strSearch,
            'aoColnmns' => json_encode($aoColnmns),
        );
    }

    // 首页展示之前的操作
    protected function beforeIndex($model){return true;}

    // 首页
    public function index()
    {
        $model = D($this->model);
        $this->beforeIndex($model);                         // 之前的处理
        $arrRowFluid = $this->allotFluidContent($model);    // 分配内容显示

        // 注入变量
        $this->assign($this->tableField($model));           // 显示表头信息(搜索和标题)
        $this->assign(array(
            'arrRowFluid' => $arrRowFluid,                  // 主要内容
            'title'       => $this->title,                  // 标题
        ));

        // 加载模板
        $this->display('Layout/baseindex');
    }

    /**
     * handleValue() 数据显示之前的处理
     * @param  array  $value 处理的数组
     * @param  bool   $isAll 是否是多维数组
     * @return bool   返回 true
     */
    public function handleValue(&$value, $isAll = true){ return true;}

    /**
     * datalimit() 处理查询数据条数LIMIT限制条件
     * @params int $int 没有分页数(默认15条)
     * @return string 返回LIMIT 限制条件
     */
    protected function dataLimit()
    {
        return get('iDisplayStart', 0).','.get('iDisplayLength');
    }

    /**
     * setOperate() 设置按钮信息
     */
    public function setOperate($strKey, $strAttr, $maxValue)
    {
        $arrKey = explode(',', $strKey);
        foreach ($arrKey as $value)
        {
            // 存在就复制
            if(isset($this->arrOperateButton[$value]))
            {
                $this->arrOperateButton[$value]['other'][$strAttr] = $maxValue;
            }
        }
        return true;
    }

    /**
     * beforeSearch()处理排序信息
     * @access public
     * @param  object $model 查询的模型
     */
    public function beforeSearch($model)
    {
        // 处理排序
        $intSort  = (int)get('iSortCol_0');  // 排序字段
        $strOrder = get('sSortDir_0');       // 排序类型
        if ($strOrder)
        {
            $strSort = $model->arrShowTh[$intSort]['name'];
            $this->strSort = $strSort . ' ' .$strOrder;
        }

        // 处理查询
        $strSearch = get('sSearch');
        if (! empty($strSearch))
        {
            $arrSearch = explode(',', $model->strLike);
            foreach ($arrSearch as &$value) $value = '`'.$value .'` LIKE \'%'.$strSearch.'%\'';
            $this->arrWhere[] = '(' . implode(' OR ', $arrSearch) . ')';
        }

        // 处理查询信息
        $arrSearch = $this->filterGet($_GET);
        if ($arrSearch)
        {
            $arrTime = array('createtime');
            foreach ($arrSearch as $key => $value)
            {
                $strAnd = isset($model->arrShowTh[$key]['search']['and']) ? $model->arrShowTh[$key]['search']['and'] : '=';
                if ($strAnd === 'LIKE') $value = '%'.$value.'%';
                if (in_array($model->arrShowTh[$key]['name'], $arrTime)) $value = strtotime($value);
                $this->arrWhere[] = "(`{$model->arrShowTh[$key]['name']}` {$strAnd} '{$value}')"; ;
            }
        }
    }

    public function filterGet($arrData, $strPrefix = 'sSearch_')
    {
        $arrReturn = array();
        if (!empty($arrData))
        {
            foreach ($arrData as $key => $value)
            {
                if ($value === '') continue;            // 为空过滤掉
                $strTmp = stristr($key, $strPrefix);    // 取出字符串
                if ($strTmp) $arrReturn[trim($strTmp, $strPrefix)] = $value;
            }
        }

        return $arrReturn;
    }

    // 获取数据
    public function getDatas()
    {
        // 开始接收参数
        $model = D($this->model);

        // 查询条件
        $this->beforeSearch($model);

        $strWhere = implode(' AND ', $this->arrWhere); // 处理查询条件

        // 查询数据总条数
        $total = $model->where($strWhere)->count();

        // 分页查询
        $data  = $model->where($strWhere)->order($this->strSort)->limit($this->dataLimit())->select();
        if ($data)
        {
            // 添加按钮
            foreach ($data as $key => &$value)
            {
                if ($this->isOperate)
                {
                    $this->setOperate('zoom-in,edit,trash', 'vid', $value[$this->strPk]);
                    $value['operate'] = $this->showOperate($this->arrOperateButton);
                }
            }

            // 处理值
            $this->handleValue($data);
        }
        else
            $data = array();

        // 返回数据
        exit(json_encode(array(
            'sEcho'                 => $_GET['sEcho'],
            'iTotalRecords'         => count($data),
            'iTotalDisplayRecords'  => intval($total),
            'aaData'                => $data,
        )));
    }

    /**
     * getOne() 获取新的数据
     * @param int    $intId 查询的ID
     * @param object $model
     * @return array 返回数组
     */
    public function getOne($intId, $model)
    {
        $arrData   = $model->find($intId);
        $arrReturn = array();
        if ($arrData)
        {
            $this->handleValue($arrData, false);
            foreach ($model->arrShowTh as $value)
            {
                $strKey = $value['name'];
                $arrReturn[$strKey] = $arrData[$strKey];
            }

            if ($this->isOperate)
            {
                $this->setOperate('zoom-in,edit,trash', 'vid', $arrData[$this->strPk]);
                $arrReturn['operate'] = $this->showOperate($this->arrOperateButton);
            }
        }

        return $arrReturn;
    }

    /**
     * returnAjax() 返回数据给AJAX
     * @access protected
     * @param  array $arrData   返回状态
     */
    protected function returnAjax($arrData) {exit(json_encode($arrData));}

    /**
     * delete()数据的删除
     */
    public function delete()
    {
        // 接收参数
        $intId    = get('id');        // 获取参数
        $arrError = $this->arrError;  // 默认返回
        if ($intId)
        {
            $isTrue = D($this->model)->delete($intId);
            $arrError['msg'] = $this->strError;
            if ($isTrue) $arrError = $this->arrSuccess;
        }

        // 返回数据
        $this->returnAjax($arrError);
    }

    // 获取修改数据信息
    public function getEditData()
    {
        // 接收参数
        $intId    = get('id');          // 数据ID
        $arrError = $this->arrError;    // 默认字符
        $isHanlde = get('handle');      // 是否处理(用于查看详情信息)
        if ($intId)
        {
            $model   = D($this->model);
            $arrData = $model->find(intval($intId));
            if ($arrData)
            {
                $arrError = $this->arrSuccess;
                if (!empty($isHanlde)) $this->handleValue($arrData, false);
                $arrError['data'] = $arrData;
            }
        }

        // 返回数据
        $this->returnAjax($arrError);
    }

    /**
     * beforeUpdate() 修改之前的处理
     * @access protected
     * @param  object $model 模型对象
     * @param  string $str   提示信息
     * @return bool   执行成功返回true
     */
    protected function beforeUpdate($model, &$str) { return true;}

    // 修改数据和新增数据
    public function update()
    {
        $model    = D($this->model);
        $arrError = $this->arrError;

        // 判断数据提交
        if (isset($_POST) && ! empty($_POST))
        {
            // 自动验证
            $isTrue = $model->create();
            $arrError['msg'] = $model->getError();
            if ($isTrue)
            {
                $model->isNew = isset($model->id) && ! empty($model->id) ? false : true;
                $strPk        = $this->strPk;
                $intId        = $model->$strPk;
                // 验证成功修改之前的处理
                if ($this->beforeUpdate($model, $arrError['msg']))
                {
                    $arrError['msg'] = $this->strError;
                    if ($model->isNew)
                        $isTrue = $model->add();
                    else
                        $isTrue = $model->save();
                    if ($isTrue)
                    {
                        if ($model->isNew) $intId = $isTrue;
                        $arrError = $this->arrSuccess;
                        $arrError['data'] =  $this->getOne($intId, $model);
                    }
                }
            }
        }

        $this->returnAjax($arrError);
    }

    /**
     * showTable() 显示表格信息
     */
    public function showTable($arrData)
    {
        // 表头信息
        $strHtml = ' <table class="table table-bordered table-striped table-detail">
        <tbody>';

        // 内容信息
        if ($arrData)
        {
            foreach ($arrData as $key => $value)
            {
                $strHtml .= '<tr>';
                $strHtml .= '<td width="25%">'.$value.'</td>';
                $strHtml .= '<td class="detailTable_'.$key.' details"></td>';
                $strHtml .= '</tr>';
            }
        }

        $strHtml .= '</tbody>
        </table>';
        return $strHtml;
    }

    /**
     * showStatus() 处理显示状态信息
     * @access protected
     * @param  int   $intStatus  状态值
     * @param  array $arrStatus  状态信息
     * @param  array $arrColor   显示演示信息
     */
    protected function showStatus($intStatus, $arrStatus, $arrColor)
    {
        $strColor  = $arrColor[$intStatus];
        $strStatus = $arrStatus[$intStatus];
        return "<span class=\"label label-{$strColor}\">{$strStatus}</span>";
    }
}