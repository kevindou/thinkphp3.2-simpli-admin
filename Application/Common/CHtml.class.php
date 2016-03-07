<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2015/12/31
 * Time: 10:04
 */
namespace Common;
// 定义命名空间
use yii\helpers\Html;
use yii\web\Link;

/**
 * Class CHtml
 * @package Common
 * Desc: 用来生成HTML信息
 */
class CHtml
{
    /**
     * setOption() 生成下拉菜单和单选按钮的数据(id => name)
     * @param array  $data  需要处理的数据
     * @param string $key   生成的键
     * @param string $val   生成的值
     * @param string $isStr 是否位字符串
     * @return array 返回处理的值
     */
    public static function setOption($data, $key, $val, $isStr = false)
    {
        $return = array();
        if ($data && is_array($data))
        {
            if (false === $isStr)
                foreach ($data as $value) $return[$value[$key]] = $value[$val];
            else
                foreach ($data as $value) $return[] = $value[$key] .':'.$value[$val];
        }

        return false === $isStr ? $return : implode(';', $return);
    }

    /**
     * setColModel() 生成jqGrid() 需要的列信息和字段信息
     * @param array $arrData 需要处理生成的数据
     * @
     */
    public static function setColModel($arrData, $attribute = array())
    {
        $colNames = array();    // 显示列名
        $colModel = array();    // 显示列信息
        if ($arrData)
        {
            $colNames[] = '操作';
            // 默认添加列
            $colModel[] = array(
                'name' => 'myac',
                'width' => 80,
                'fixed' => true,
                'sortable'  => false,
                'resize'    => false,
                'formatter' => 'actions',
                'formatoptions' => array(
                    'delOptions' => array(
                        'recreateForm'   => 'true',
                        'beforeShowForm' => 'beforeDeleteCallback'
                    ),
                )

            );

            // 处理数据据
            foreach ($arrData as $key => $value)
            {
                $colNames[] = $attribute[$key];
                $key        = strtolower($key);     // 配合ThinkPHP转小写
                $colModel[] = array_merge(array('name' => $key, 'index' => $key, 'editable' => true), $value);
            }
        }

        return array(
            'colNames' => json_encode($colNames),
            'colModel' => json_encode($colModel),
        );
    }

    /**
     * actTableCol() jquery.dataTable   生成列信息
     * @param array $arrTableAttributes 列字段信息
     * @param array $options            其他添加参数
     * @return array 返回列和搜索信息
     */
    public static function aceTableCol(array $arrTableAttributes, $options = array())
    {
        // 初始化定义
        $intIndex      = 0;
        $arrAttributes = array(
            'aoColumns' => array(),
            'strSearch' => '',
        );

        foreach ($arrTableAttributes as $key => $value)
        {
            // 判断是否添加搜索条件
            if (isset($value['search']) && ! empty($value['search']))
            {
                // 默认添加搜索属性
                $value['search']['options']['index'] = $intIndex;
                $value['search']['options']['class'] = 'me-search';
                switch ($value['search']['type'])
                {
                    case 'select':
                        $strInput = self::select($value['search']['value'], $key, $value['search']['selected'], $value['search']['options']);
                        break;
                    default:
                        $strInput = self::input('text', $key, $value['value'], $value['search']['options']);
                        break;
                }

                $arrAttributes['strSearch'] .= self::tag('label', $value['title'].':'.$strInput);
                unset($value['search']);
            }

            // 默认赋值
            $aoColumns = array(
                'data'      => isset($value['data']) ? $value['data'] : $key,
                'sName'     => $key,
                'sTitle'    => $value['title'],
                'bSortable' => true,
            );

            // 重新覆盖
            $arrAttributes['aoColumns'][] = array_merge($aoColumns, $value);
            $intIndex ++;
        }

        $arrAttributes['aoColumns'] = json_encode($arrAttributes['aoColumns']);
        return $arrAttributes;
    }

    public static function aceThOperates($buttons = array(), $options = array())
    {
        $strButtons = '';
        $strLiA     = '';
        foreach ($buttons as $key => $value)
        {
            // 隐藏按钮
            if (in_array($key, $options)) continue;

            // 默认赋值
            $tmpOptions = $value['options'];
            $tmpOptions['title'] = $tmpOptions['data-original-title'] = $value['title'];

            // icon
            $strIcon = '<i class="ace-icon fa fa-'.$key.' bigger-120"></i>';

            // 按钮
            $tmpOptions['class'] = 'btn btn-xs '.$value['class'];
            $strButtons .= self::tag('button', $strIcon, $tmpOptions);

            // 隐藏按钮
            $tmpOptions['data-rel'] = 'tooltip';
            $tmpOptions['href']     = '#';
            $tmpOptions['class']    = $value['a-class'];
            $strLiA     .= '<li>'.self::tag('a', '<span class="'.$value['span-class'].'">'.$strIcon.'</span>', $tmpOptions).'</li>';
        }

        return <<<HTML
        <div class="hidden-sm hidden-xs btn-group">
            {$strButtons}
        </div>

        <div class="hidden-md hidden-lg">
            <div class="inline position-relative">
                <button data-position="auto" data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
                    <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                </button>

                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                    {$strLiA}
                </ul>
            </div>
        </div>
HTML;


    }

    /**
     * aceForm() 生成表单
     * @access public
     * @param  array $arrFormAttributes 表单字段信息
     * @param  array $options           表单标签的其他属性
     */
    public static function aceForm(array $arrFormAttributes, $options = array())
    {
        $html = '';
        foreach ($arrFormAttributes as $key => $value)
        {
            switch ($value['type'])
            {
                case 'select':
                    $html .= CHtml::select($value['value'], $key, $value['default'], $value['options'], $value['label']);
                    break;
                case 'radio':
                    $html .= CHtml::radio($value['value'], $key, $value['default'], $value['options'], $value['label']);
                    break;
                case 'textarea':
                    $html .= CHtml::aceFormGroup($value['label'], $key, self::tag('textarea', $value['default'], $value['options']));
                    break;
                default:
                    $html .= self::input($value['type'], $key, $value['value'], $value['options'], $value['label']);
                    break;
            }
        }

        // 添加错误提示信息
        $html .= self::aceFormGroup('错误提示', '', '<label class="error '.$options['name'].'-label ">服务器繁忙,请稍候再试...</label>', array('addClass' => 'has-error is-hide '.$options['name'].'-error'));

        // 添加提交和重置按钮
        if (isset($options['buttons']) && !empty($options['buttons']))
        {
            $html .= <<<HTML
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info btn-submit" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        提交
                    </button>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        重置
                    </button>
                </div>
            </div>
HTML;

            unset($options['buttons']);
        }

        return self::tag('form', $html, $options);
    }

    /**
     * aceFormGroup() 生成ace的表单字段信息
     * @param string $label   label 标签内容信息
     * @param string $title   input name 名称
     * @param string $input   input 标签信息
     * @param array  $options 添加其他信息
     * @return string
     */
    public static function aceFormGroup($label, $title, $input, $options = array())
    {
        $strClass = 'form-group';
        if (isset($options['addClass'])) $strClass .= ' '.$options['addClass'];
        return  <<<Html
        <div class="{$strClass}">
            <label class="col-sm-3 control-label no-padding-right" for="{$title}">{$label}:</label>
            <div class="col-sm-9">
                <div class="clearfix">
                    {$input}
                </div>
            </div>
        </div>
Html;
    }

    /**
     * input() 生成input 标签
     * @param string $type    input 类型
     * @param string $title   input name类型
     * @param string $value   input value 默认值
     * @param array  $options input 标签的其他属性信息
     * @param string $label   input 是否使用ace label的样式
     * @return string 返回HTML标签信息
     */
    public static function input($type, $title = null, $value = null, $options = array(), $label = '')
    {
        $options['type']  = empty($type) ? 'text' : (string)$type;
        $options['name']  = $title;
        $options['value'] = $value === null ? null : (string)$value;
        $options['class'] = isset($options['class']) ? $options['class'] : 'col-sm-12';//'col-xs-10 col-sm-5';
        $html = self::tag('input', '', $options);
        return !empty($label) ? self::aceFormGroup($label, $title, $html) : $html;
    }

    /**
     * radio() 生成单选按钮组
     * @param array  $array     radio 的数据源信息
     * @param string $name      radio 的 name
     * @param mixed  $checked   radio 的 默认选项
     * @param array  $options   其他选项
     * @param string $label   input 是否使用ace label的样式
     * @return string 返回按钮组HTML信息
     */
    public static function radio(array $array, $name, $checked = 0, $options = array(), $label = '')
    {
        $html = '';
        $options['class'] = 'ace';
        foreach ($array as $key => $val)
        {
            $options['checked'] = $key == $checked ? 'true' : 'false';
            $html .= '<label class="line-height-1 blue"> '.self::input('radio', $name, $key, $options)." <span class=\"lbl\"> $val </span></label>　";
        }

        return !empty($label) ? self::aceFormGroup($label, $name, $html) : $html;
    }

    /**
     * select() 生成下拉菜单信息
     * @param array  $array    下来菜单的信息('1' => '启用'))
     * @param string $name     下来菜单信息name
     * @param mixed  $selected 下来菜单默认选中
     * @param array  $options
     */
    public function select(array $array, $name, $selected = null, $options = array(), $label)
    {
        $html = '<option>请选择</option>';
        foreach ($array as $key => $value)
        {
            $selected = $key === $selected ? 'selected="selected"' : '';
            $html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
        }

        $options['name'] = $name;
        $html = self::tag('select', $html, $options);
        return !empty($label) ? self::aceFormGroup($label, $name, $html) : $html;
    }

    /**
     * tag() 生成HTML标签
     * @param string $name    生成的标签名
     * @param string $content 标签的内容信息
     * @param array  $options 其他选项
     * @return string
     */
    public static function tag($name, $content = '', $options = array())
    {
        $html = "<$name".self::setTagAttributes($options).'>';
        if ($content) $html .= $content."</{$name}>";
        return $html;
    }

    /**
     * setTagAttributes() 处理标签中属性和值的设置
     * @param  arry $options 选项数组id => 'nid'
     * @return string
     */
    public static function setTagAttributes($options)
    {
        $attributes = '';
        if (!empty($options))
        {
            foreach ($options as $key => $value)
            {
                $attributes .= ' '.$key.'='."\"{$value}\" ";
            }
        }

        return $attributes;
    }

    public static function aceTableInfo($attributes, $options = array())
    {
        // 生成单元格
        $html = '';
        foreach ($attributes as $key => $value) $html .= '<tr><td class="col-xs-3 text-right">'.$value.'</td><td class="col-xs-9 data-detail info-'.$key.'"></td></tr>';

        // 生成表格
        $options['class'] = 'table table-bordered table-striped '.$options['class'];
        return self::tag('table', $html, $options);
    }

    public static function setOptions(array $array, $key, $name)
    {
        $arrReturn = array();
        if ( ! empty($array))
        {
            foreach ($array as  $value) $arrReturn[$value[$key]] = $value[$name];
        }

        return $arrReturn;
    }

}