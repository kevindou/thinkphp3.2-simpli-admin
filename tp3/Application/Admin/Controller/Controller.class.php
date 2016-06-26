<?php
/**
 * file: Controller.class.php
 * desc: 后台公共控制器
 * user: liujx
 * date: 2016-3-12
 */

// 定义命名空间
namespace Admin\Controller;

// 引入命名空间
class Controller extends \Common\Controller
{

    // 定义验证字段
    private $validate = array();

    // 初始化判断定义
    public function _initialize()
    {
        // 判断是否已经登录
        if ( ! $this->isLogin()) {
            if (IS_AJAX) {
                $this->arrMsg['msg'] = '请先登录...';
                $this->ajaxReturn($this->arrMsg);
            } else {
                $this->redirect('Index/index');
            }
        }

        // 查询栏目信息
        $menusAll = M('menu')->field(array('id', 'pid', 'menu_name', 'url', 'icons'))->where(array('status' => 1))->order(array('sort' => 'asc'))->select();

        // 处理出一级栏目
        $arrMenus = array();
        if ($menusAll)
        {
            foreach ($menusAll as $key => $value)
            {
                $pid = $value['pid'];
                $id  = $value['id'];
                if ($pid == 0) {
                    // 一级栏目
                    if(isset($arrMenus[$id])) $value['child'] =  $arrMenus[$id]['child'];
                    $arrMenus[$id] = $value;
                } else {
                    // 不存在创建父类数组
                    if (!isset($arrMenus[$pid])) $arrMenus[$pid] = array();
                    $arrMenus[$pid]['child'][] = $value;
                }
            }
        }

        // 注入导航栏
        $this->assign('menus', $arrMenus);
    }

    // 获取数据页面
    public function index(){$this->display('Admin/'.$this->model);}

    // 查询所有数据
    public function search()
    {
        if (IS_AJAX)
        {
            $model = M($this->model);

            // 接收参数
            $intNum = (int)post('sEcho');               // 第几页
            $params = post('params');                   // 查询参数
            $order  = post('sSortDir_0', 'asc');        // 排序类型
            $start  = (int)post('iDisplayStart', 0);    // 开始位置
            $length = (int)post('iDisplayLength', 10);  // 查询长度
            $where  = array();

            // 数据处理
            if ( ! isset($params['orderBy'])) $params['orderBy'] = 'id';

            // 处理查询条件
            if ( ! empty($params))
            {
                foreach ($params as $key => $value)
                {
                    if (isset($this->where[$key]))
                    {
                        $tmpKey = $this->where[$key];
                        switch ($key)
                        {
                            case 'search':
                                $where[$tmpKey] = array('like', "%{$value}%");
                                break;
                            case 'orderBy':
                                $this->where['orderBy'] = $value;
                                break;
                            default:
                                if ($tmpKey == 'like') $value = "%{$value}%";
                                $where[$key] = array($tmpKey, $value);
                        }
                    }
                }
            }

            // 查询数据
            $count = $model->where($where)->count();
            $data  = $model->where($where)->limit($start, $length)->order(array($this->where['orderBy'] => $order))->select();
            $this->arrMsg = array(
                'status' => 1,
                'msg'    => 'success',
                'data'   => array(
                    'sEcho'                => $intNum,
                    'iTotalRecords'        => count($data),
                    'iTotalDisplayRecords' => (int)$count,
                    'aaData'               => $data,
                ),
            );
        }

        $this->ajaxReturn($this->arrMsg);
    }

    // 修改数据
    public function update()
    {
        if (IS_AJAX)
        {
            // 接收参数
            $type    = post('actionType');                  // 操作类型
            $arrType = array('delete', 'insert', 'update'); // 可执行操作
            $this->arrMsg['msg'] = "操作类型错误";

            // 操作类型判断
            if (in_array($type, $arrType))
            {
                // 数据验证
                $model  = M($this->model);
                $isTrue = $model->validate($this->validate)->create();
                $this->arrMsg['msg'] = $model->getError();

                // 数据验证通过
                if ($isTrue || $type === 'delete')
                {
                    $isTrue = false;
                    $this->arrMsg['msg'] = '服务器繁忙,请稍候再试...';

                    switch($type)
                    {
                        case 'delete':
                            if ($this->beforeDelete($model)) $isTrue = $model->delete();
                            break;
                        case 'update':
                            if ($this->beforeUpdate($model)) $isTrue = $model->save();
                            break;
                        case 'insert':
                            if ($this->beforeInsert($model)) $isTrue = $model->add();
                            break;
                    }

                    $this->arrMsg['data'] = $model->getLastSql();
                    // 判断操作成功
                    if ($isTrue)
                    {
                        $this->arrMsg = array(
                            'status' => 1,
                            'msg'    => '恭喜您,操作成功 ^.^',
                            'data'   => $isTrue,
                        );
                    }
                }
            }
        }

        $this->ajaxReturn($this->arrMsg);
    }

    // 新增之前的处理
    protected function beforeInsert(&$model)
    {
        $model->update_id   = $model->create_id   = $_SESSION[$this->_admin]['id'];
        $model->update_time = $model->create_time = time();
        return true;
    }

    // 修改之前的处理
    protected function beforeUpdate(&$model)
    {
        $model->update_id   = $_SESSION[$this->_admin]['id'];
        $model->update_time = time();
        return true;
    }

    // 删除之前的处理
    protected function beforeDelete(&$model) {return true;}

    // 图片处理函数
    protected function handleImage($path){ return true; }
}