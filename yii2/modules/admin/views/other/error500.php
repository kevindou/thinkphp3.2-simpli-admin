<?php use yii\helpers\Url; ?>
<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="ace-icon fa fa-random"></i>
                500
            </span>
            出了差错
        </h1>

        <hr />
        <h3 class="lighter smaller">
            我们正在修复
            <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
            他!
        </h3>

        <div class="space"></div>

        <div>
            <h4 class="lighter smaller">同时，试着下面的一个：</h4>

            <ul class="list-unstyled spaced inline bigger-110 margin-15">
                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    阅读常见问题
                </li>

                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    给我们更多的信息，如何发生这种特定的错误!
                </li>
            </ul>
        </div>

        <hr>
        <div class="space"></div>
        <div class="center">
            <a href="javascript:history.back()" class="btn btn-grey">
                <i class="ace-icon fa fa-arrow-left"></i>
                回去
            </a>

            <a href="<?php echo Url::to(['admin/index']); ?>" class="btn btn-primary">
                <i class="ace-icon glyphicon glyphicon-user"></i>
                管理员信息
            </a>
        </div>
    </div>
</div>