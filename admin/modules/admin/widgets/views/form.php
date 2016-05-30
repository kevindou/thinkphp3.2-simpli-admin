<?php
// 引入小部件
use yii\widgets\ActiveForm;
use yii\Helpers\Html;

$form = ActiveForm::begin([
    'id'      => 'update-form',
    'action'  => [\Yii::$app->controller->id.'/update'],
    'method'  => 'post',
    'options' => [
        'novalidate' => 'novalidate',
        'name'       => 'update-form',
        'class'      => 'form-horizontal update-form is-hide',
        'role'       => 'form',
    ]
]);
// 循环处理
foreach ($attributes as $key => $value) :
    // 初始化赋值
    $value['type']    = isset($value['type']) ? $value['type'] : 'text';
    $value['value']   = isset($value['value']) ? $value['value'] : '';
    $value['options'] = isset($value['options']) ? $value['options'] : [];
    $value['options']['id'] = 'me_'.$key;                                   // ID

    // 判断类型生成HTML
    switch ($value['type'])
    {
        // 输入框
        case 'hidden':
        case 'text':
        case 'password':
            $value['options']['class'] = 'col-sm-12';
            $html = Html::input($value['type'], $key, $value['value'], $value['options']);
            break;

        // 单选框
        case 'radio':
            $html = '';
            foreach ($value['value'] as $k => $v)
            {
                $value['options']['value'] = $k;
                $value['options']['class'] = 'ace';
                $value['options']['id']    = 'me_'.$key.$k;
                $is_checked = $k == $value['default'];
                $radio = Html::radio($key, $is_checked, $value['options']).'<span class="lbl"> '.$v.' </span>';
                $html .= Html::label($radio, $value['options']['id'], ['class' => 'line-height-1 blue']). '　';
            }

            break;

        // 下拉列表
        case 'select':
                $html = Html::dropDownList($key, $value['default'], $value['value'], $value['options']);
            break;
    }

    // 隐藏字段信息
    if ($value['type'] == 'hidden')
    {
        echo $html;
        continue;
    }
?>
<div class="form-group">
    <?= Html::label($labels[$key], $value['options']['id'], ['class' => 'col-sm-3 control-label no-padding-right']) ?>
    <div class="col-sm-9">
        <div class="clearfix">
            <?= $html ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="form-group has-error is-hide update-form-error">
    <label class="col-sm-3 control-label no-padding-right" for="m-error-update">错误提示:</label>
    <div class="col-sm-9">
        <div class="clearfix">
            <label class="error update-form-label ">服务器繁忙,请稍候再试...</label>
        </div>
    </div>
</div>

<?php if ($isSubmit) : ?>
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
<?php endif; ?>
<?php ActiveForm::end(); ?>


