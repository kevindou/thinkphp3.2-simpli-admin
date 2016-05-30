<?php use yii\helpers\Url; ?>
<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="ace-icon fa fa-sitemap"></i>
                404错误
            </span>
            页面没有找到
        </h1>
        <hr />
        <h3 class="lighter smaller">我们到处找，但找不到！</h3>
        <div>
            <form class="form-search">
                <span class="input-icon align-middle">
                    <i class="ace-icon fa fa-search"></i>
                    <input type="text" class="search-query" placeholder="搜索…" />
                </span>
                <button class="btn btn-sm" type="button">Go!</button>
            </form>

            <div class="space"></div>
            <h4 class="smaller">尝试下列之一：</h4>

            <ul class="list-unstyled spaced inline bigger-110 margin-15">
                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    重新检查拼写错误的URL
                </li>

                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    阅读常见问题
                </li>

                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    告诉我们
                </li>
            </ul>
        </div>

        <hr />
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