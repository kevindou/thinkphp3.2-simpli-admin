<?php
    use yii\helpers\Html;
    $operates = $model->getOperate();

    // 初始化定义
    $str_buttons = $str_a = '';

    // 判断存在
    if ($operates)
    {
        foreach ($operates as $key => $value)
        {
            // 默认赋值
            $options = isset($value['options']) ? $value['options'] : [];
            $options['title'] = $options['data-original-title'] = $value['title'];

            // icon
            $str_icon = '<i class="ace-icon fa fa-'.$key.' bigger-120"></i>';

            // 按钮
            $options['class'] = 'btn btn-xs '.$value['class'];
            $str_buttons .= Html::button($str_icon, $options);

            // 隐藏按钮
            $options['data-rel'] = 'tooltip';
            $options['class']    = $value['a-class'];
            $str_a    .= '<li>'.Html::a('<span class="'.$value['span-class'].'">'.$str_icon.'</span>', '#', $options);
        }
    }
?>
<?php if ($operates) : ?>
<div class="hidden-sm hidden-xs btn-group">
    <?= $str_buttons ?>
</div>

<div class="hidden-md hidden-lg">
    <div class="inline position-relative">
        <button data-position="auto" data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle">
            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
        </button>

        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
            <?= $str_a ?>
        </ul>
    </div>
</div>
<?php endif; ?>