<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

use Think\Model;

// 引入命名空间
class ModuleController extends Controller
{
    // 首页显示
    public function index()
    {
        $this->display('Admin/module');
    }

    // 生成HTML
    public function create()
    {
        if (IS_AJAX && IS_POST)
        {
            $sH2        = post('h2');             // h2标题
            $sFileName  = post('filename');       // 生成文件名
            $sTableName = post('tablename');      // 表名字
            $bCreate    = (int)post('isCreate');  // 是否生成文件

            // 数据不能为空
            if ($sH2 && $sFileName && $sTableName)
            {
                // 查询表信息
                $aData  = (new Model())->query('SHOW FULL COLUMNS FROM `'.$sTableName.'`');
                $html  = '';
                if ($aData) {
                    foreach ($aData as $value)
                    {
                        $sTitle  = isset($value['comment']) && ! empty($value['comment']) ? $value['comment'] : $value['field'];
                        $sOption = isset($value['null']) && $value['null'] == 'NO' ? '"required":true,' : '';
                        if (stripos($value['type'], 'int(') !== false) $sOption .= '"number":true,';
                        if (stripos($value['type'], 'varchar(') !== false) {
                            $sLen = trim(str_replace('varchar(', '', $value['type']), ')');
                            $sOption .= '"rangelength":"[2, '.$sLen.']"';
                        }

                        $sOther = '';
                        if (stripos($value['field'], 'time') !== false) $sOther .= '"createdCell":dateTimeString,';
                        $html    .="\t\t\t".'{"data":"'.$value['field'] .'", "sName":"'.$value['field'].'", "title":"'.$sTitle.'", "edit":{"options":{'.$sOption.'}}, '.$sOther.'},'."\n";
                    }

                    $html .= "\t\t\t".'oOperate';
                }

                $sHtml = <<<html
<!--前面导航信息-->
<div class="box-header" data-original-title="">
    <h2><i class="icon-desktop"></i><span class="break"></span></h2>
    <div class="box-icon">
        <a title="添加" href="#" class="me-table-insert"><i class="icon-plus"></i></a>
        <a id="table-refresh" class="me-table-reload" title="刷新" href="#"><i class="icon-refresh"></i></a>
        <a id="toggle-fullscreen" class="hidden-phone hidden-tablet" title="全屏" href="#"><i class="icon-fullscreen"></i></a>
        <a class="btn-minimize" title="隐藏" href="#"><i class="icon-chevron-up"></i></a>
        <a class="btn-close" title="删除" href="#"><i class="icon-remove"></i></a>
    </div>
</div>
<div class="box-content">
    <!--表格数据-->
    <table class="table table-striped table-bordered table-hover" id="showTable"></table>
</div>
<script type="text/javascript">
    var myTable = new MeTable({sTitle:"{$sH2}"},{
        "aoColumns":[
{$html}
        ],

        // 设置隐藏和排序信息
        // "order":[[0, "desc"]],
        // "columnDefs":[{"targets":[2,3], "visible":false}],
    });

    $(function(){
        myTable.init();
    })
</script>
html;
                // 判断是否生成文件
                $sMsg = '生成预览文件成功';
                if ($bCreate === 1)
                {
                    $sMsg = '生成文件成功 ^.^';
                    file_put_contents(APP_PATH.'/Admin/View/Admin/'.$sFileName, $sHtml);
                }

                // 返回数据
                $this->arrMsg = [
                    'status' => 1,
                    'msg'    => $sMsg,
                    'data'   => highlight_string($sHtml, true),
                ];
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }
}