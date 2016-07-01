<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

use Common\Auth;
use Think\Model;

// 引入命名空间
class ModuleController extends Controller
{
    private $dir = '';
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
            $sTableName = post('tablename');      // 表名字
            $bCreate    = (int)post('isCreate');  // 是否生成文件
            $auth       = post('auth');           // 生成权限
            $menu       = post('menu');           // 生成导航栏信息
            $cont       = post('cont');           // 生成控制器

            // 数据不能为空
            if ($sH2 && $sTableName)
            {
                $sName  = trim($sTableName, 'my_');
                // 查询表信息
                $aData  = (new Model())->query('SHOW FULL COLUMNS FROM `'.$sTableName.'`');
                $html   = '';
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

                // 生成控制器信息
                if ( ! empty($cont) && $bCreate === 1)
                {
                    $controller     = ucfirst($sName).'Controller';
                    $fileName       = $controller.'.class.php';
                    $date           = date('Y-m-d H:i:s');
                    $strControllers = <<<Html
<?php
/**
 * file: {$fileName}
 * desc: {$sH2} 执行操作控制器
 * user: liujx
 * date: {$date}
 */

// 引入命名空间
namespace Admin\Controller;

class {$controller} extends Controller
{
    // model
    protected \$model = '{$sTableName}';

    // 查询方法
    public function where(\$params)
    {
        return [
            'orderBy' => 'id',
        ];
    }

    // 新增之前的处理
    protected function beforeInsert(&\$model)
    {
        \$model->update_id   = \$model->create_id   = \$this->user->id;
        \$model->update_time = \$model->create_time = time();
        return true;
    }

    // 修改之前的处理
    protected function beforeUpdate(&\$model)
    {
        \$model->update_id   = \$this->user->id;
        \$model->update_time = time();
        return true;
    }
}
Html;
                    file_put_contents(APP_PATH.'/Admin/Controller/'.$fileName, $strControllers);
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
                    // 生成权限
                    if (! empty($auth)) $this->createAuth($auth, $sH2);

                    $time = time();
                    // 生成导航栏目
                    if (! empty($menu)) M('menu')->add([
                        'menu_name'   => $sH2,
                        'pid'         => 0,
                        'icons'       => 'icon-cog',
                        'url'         => '/admin/'.$sName.'/index',
                        'status'      => 1,
                        'create_time' => $time,
                        'create_id'   => $this->user->id,
                        'update_time' => $time,
                        'update_id'   => $this->user->id,
                    ]);

                    $sMsg = '生成文件成功 ^.^';
                    file_put_contents(APP_PATH.'/Admin/View/Admin/'.$sName, $sHtml);
                }

                // 返回数据
                $this->arrError = [
                    'status' => 1,
                    'msg'    => $sMsg,
                    'data'   => highlight_string($sHtml, true),
                ];
            }
        }

        $this->ajaxReturn();
    }

    // 生成权限操作
    private function createAuth($prefix, $title)
    {
        $prefix = '/'.trim($prefix, '/').'/';
        $auth = ['index' => '显示', 'search' => '搜索', 'update' => '编辑'];
        foreach ($auth as $key => $value) Auth::createItem($prefix.$key, $title.$value, Auth::AUTH_TYPE);
    }
}