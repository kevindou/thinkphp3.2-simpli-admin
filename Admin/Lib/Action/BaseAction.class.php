<?php
/**
 * file: BaseAction.php
 * desc: 后台首页
 * user: liujx
 * date: 2016-3-15
 */

class BaseAction extends  Action {
    // 定义返回类型
    public $arrMsg = array(
        'status' => 0,
        'msg'    => '提交数据为空',
        'data'   => array(),
    );

    protected $session = 'gt_adminuser';    // SESSION名称

    // 初始化判断用户登录
    public function _initialize()
    {
        // 验证用户是否已经登录
        if (! isset($_SESSION[$this->session]) || empty($_SESSION[$this->session]))
        {
            session_destroy();
            header('Location:/admin.php');
            exit;
        }
    }

    // 首页显示
    public function index()
    {
        $this->display('Admin/'.$this->model);
    }

    // 查询所有数据
    public function getAll()
    {
        if (IS_AJAX)
        {
            $model = D($this->model);

            // 接收参数
            $intNum = (int)post('sEcho');               // 第几页
            $params = post('params');                   // 查询参数
            $order  = post('sSortDir_0', 'asc');        // 排序类型
            $start  = (int)post('iDisplayStart', 0);    // 开始位置
            $length = (int)post('iDisplayLength', 10);  // 查询长度
            $where  = array();

            // 数据处理
            if ( ! isset($params['orderBy'])) $params['orderBy'] = 'id';

            // 定义查询类型
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

        exit(json_encode($this->arrMsg));
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
                $model  = D($this->model);
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

        exit(json_encode($this->arrMsg));
    }

    // 新增之前的处理
    protected function beforeInsert(&$model) {return true;}

    // 修改之前的处理
    protected function beforeUpdate(&$model) {return true;}

    // 删除之前的处理
    protected function beforeDelete(&$model) {return true;}

    // 修改时忽略字段
    protected  function updateIgnore(&$model, $attributes)
    {
        if (!empty($attributes)) foreach ($attributes as $value) unset($model->$value);
    }
}