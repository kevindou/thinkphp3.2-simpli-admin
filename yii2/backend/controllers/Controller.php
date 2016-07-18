<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\Admin;
use backend\models\Init;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * Class    PraiseController
 * @package backend\controllers
 * Desc     后台公共的控制器
 * User     liujx
 * Date     2016-4-8
 */
class Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;    // 'enableCsrfValidation' => true // 配置文件关闭CSRF
    // 定义响应请求的返回数据
    public $arrError = [
        'status' => 0,
        'code'   => 201,
        'msg'    => '',
        'data'   => [],
    ];

    // 定义查询数组
    public $search = [
        'orderBy' => 'id',
    ];

    // 游戏信息、语言版本、管理员信息、状态信息
    protected $games, $lang, $admins, $status;

    // 初始化处理
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    // 权限验证
    public function beforeAction($action)
    {
        // 主控制器验证
        if ( ! parent::beforeAction($action)) {return false;}

        // 获取参数
        $controller = Yii::$app->controller->id;            // 控制器名
        $action     = Yii::$app->controller->action->id;    // 方法名
        $permissionName = $controller.'/'.$action;          // 权限值

        // 验证权限
        if( ! \Yii::$app->user->can($permissionName) && Yii::$app->getErrorHandler()->exception === null)
        {
            // 没有权限AJAX返回
            if (Yii::$app->request->isAjax)
                exit(json_encode(['status' => 0, 'msg' => '对不起，您现在还没获得该操作的权限!', 'data' => [],]));
            else
                throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获得该操作的权限!');
        }

        // 查询导航栏信息
        $menus = Yii::$app->cache->get('navigation'.Yii::$app->user->id);
        if ( ! $menus) throw new \yii\web\UnauthorizedHttpException('对不起，您还没获得显示导航栏目权限!');

        // 注入变量信息
        Yii::$app->view->params['games'] = $this->games = Init::getAll();
        Yii::$app->view->params['totalgames'] = Init::getGame();
        Yii::$app->view->params['menus'] = $menus;

        return true;
    }

    // 首页显示
    public function actionIndex() { return $this->render('index'); }

    // 显示数据之前的查询
    public function beforeShow(&$array){}

    // 处理查询信息
    protected function getQuery($params)
    {
        $search = ['orderBy' => $this->search['orderBy'], 'where' => []];

        // 默认添加查询条件
        if (isset($this->search['where']) && ! empty($this->search['where'])) $search['where'][] = $this->search['where'];

        if ( ! empty($params))
        {
            // 处理排序字段
            if (isset($params['orderBy']) && ! empty($params['orderBy']))
            {
                $search['orderBy'] = $params['orderBy'];
                unset($params['orderBy']);
            }

            // 处理查询条件
            if (isset($params['search']) && ! empty($params['search']))
            {
                // 判断添加快速搜索条件
                if (is_array($this->search['search']))
                    $search['where'][] = [$this->search['search'][0], $this->search['search'][1], $params['search']];
                else
                    $search['where'][] = ['like', $this->search['search'], $params['search']];

                unset($params['search']);
            }

            // 处理其他查询条件
            if (! empty($params))
            {
                foreach ($params as $key => $value)
                {
                    if (empty($value) || ! isset($this->search[$key])) continue;
                    $tmpKey = $this->search[$key];
                    if (is_array($this->search[$key]))
                    {
                        // 如果数组个数大于等于2
                        if (count($tmpKey) >= 2)
                        {
                            switch ($tmpKey['type'])
                            {
                                case 'date' : $v = date($tmpKey['format'], strtotime($value)); break;
                                case 'time' : $v = strtotime($value); break;
                                default     : $v = strtotime($value); break;
                            }

                            $search['where'][] = [$tmpKey[0], $tmpKey[1], $v];
                        }
                        else // 使用自己的函数处理
                        {
                            $funName           = $tmpKey[0];
                            $search['where'][] = $this->$funName($value);
                        }
                    } else {
                        $search['where'][] = [$tmpKey, $key, $value];
                    }
                }
            }
        }

        // 添加查询条件
        if (! empty($search['where'])) array_unshift($search['where'], 'and');
        return $search;
    }

    // 查询之前的处理
    public function beforeSearch(&$query){ return true;}

    // 查询方法
    public function actionSearch()
    {
        // 定义请求数据
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            // 接收参数
            $params  = $request->post('params');                // 查询查收
            $intEcho = $request->post('sEcho');                 // 请求次数
            $sort    = $request->post('sSortDir_0',     'asc'); // 排序方式
            $sort    = $sort == 'asc' ? SORT_ASC : SORT_DESC;   // 排序方式
            $start   = $request->post('iDisplayStart',  0);     // 查询开始位置
            $size    = $request->post('iDisplayLength', 10);    // 查询条数
            $search  = $this->getQuery($params);                // 处理查询参数

            // 开始查询数据
            $query  = $this->getModel()->find()->where($search['where']);

            // 查询之前的处理
            $this->beforeSearch($query);
            $objMod = clone $query;
            $total  = $objMod->count();                          // 查询数据条数
            $array  = $query->offset($start)->limit($size)->orderBy([$search['orderBy'] => $sort])->all();
            if ($array) $this->beforeShow($array);
            // $query->offset($start)->limit($size)->orderBy([$search['orderBy'] => $sort])->createCommand()->getRawSql();

            // 返回数据
            $this->arrError['code'] = 0;
            $this->arrError['data'] = [
                'sEcho'                => $intEcho,
                'iTotalRecords'        => count($array),
                'iTotalDisplayRecords' => $total,
                'aaData'               => $array,
            ];
        }

        return $this->returnAjax();
    }

    // 编辑修改
    public function actionUpdate()
    {
        $request = Yii::$app->request;

        if ($request->isAjax)
        {
            // 接收参数
            $type = $request->post('actionType'); // 操作类型
            if ($type)
            {
                $data  = $request->post();
                unset($data['actionType']);
                $model = $this->getModel();
                $index = $model->primaryKey();

                // 修改和删除时的查询数据
                if ($type == 'update' || $type == 'delete') $model = $model->findOne($data[$index[0]]);

                // 删除数据
                if ($type == 'delete')
                {
                    $isTrue = $model->delete();
                }
                else
                {
                    // 新增数据
                    $isTrue = $model->load(['params' => $data], 'params');
                    $this->arrError['code'] = 205;
                    if ($isTrue)
                    {
                        $isTrue = $model->save();
                        $this->arrError['code'] = 206;
                        $this->arrError['msg']  = $model->getErrorString();
                    }
                }

                // 判断是否成功
                if ($isTrue) $this->arrError['code'] = 0;
                $this->arrError['data'] = $model;
            }
        }

        return $this->returnAjax();
    }

    // 编辑修改
    public function actionEdit()
    {
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            // 接收参数
            $type = $request->post('actionType'); // 操作类型
            if ($type)
            {
                $data  = $request->post();
                unset($data['actionType']);
                $model = $this->getDetailModel();
                $index = $model->primaryKey();

                // 修改和删除时的查询数据
                if ($type == 'update' || $type == 'delete') $model = $model->findOne($data[$index[0]]);

                // 删除数据
                if ($type == 'delete')
                {
                    $isTrue = $model->delete();
                }
                else
                {
                    $isTrue = $model->load(['params' => $data], 'params');
                    $this->arrError['code'] = 205;
                    if ($isTrue)
                    {
                        $isTrue = $model->save();
                        $this->arrError['code'] = 206;
                        $this->arrError['msg']  = $model->getErrorString();
                    }
                }

                // 判断是否成功
                if ($isTrue) $this->arrError['code'] = 0;
            }
        }

        return $this->returnAjax();
    }

    // 查看详情信息
    public function actionViews()
    {
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            // 接收参数
            $id = $request->get('id');
            if ($id)
            {
                $this->arrError['code'] = 0;
                $this->arrError['data'] = $this->getDetailModel()->find()->where(['parent_id' => $id])->all();
            }
        }

        return $this->returnAjax();
    }

    // 图片上传
    public function actionUpload()
    {
        // 定义请求数据
        $request = Yii::$app->request;
        if ($request->isPost) {
            // 接收参数
            $file  = $request->get('fileurl');
            $field = $request->get('field');
            if (! empty($field))
            {
                $model = new UploadForm();
                $model->scenario = $field;
                try {
                    $objFile = $model->$field = UploadedFile::getInstance($model, $field);
                    if ($objFile && $model->validate())
                    {
                        // 创建目录
                        if ($field  == 'push') {
                            $dirName  = "./public/push/".date('Ym/');
                        } else {
                            $dirName  = "./public/uploads/".date('Ym/');
                        }

                        if ( ! file_exists($dirName)) mkdir($dirName, 0777, true);
                        $this->arrError['code'] = 202;
                        $this->arrError['data'] = $dirName;
                        if (file_exists($dirName))
                        {
                            // 生成文件随机名
                            $fileName = uniqid() . '.';
                            $fileDir  = $dirName. $fileName. $objFile->extension;
                            $this->arrError['code'] = 204;
                            if ($objFile->saveAs($fileDir))
                            {
                                if (! empty($file) && file_exists('.'.$file)) unlink('.'.$file);
                                $this->arrError['code'] = 1;
                                $this->arrError['data'] = [
                                    'fileDir' => trim($fileDir, '.'),
                                    'image'   => $objFile->baseName.'.'.$objFile->extension,
                                ];
                            }
                        }
                    } else {
                        $this->arrError['msg'] = $model->getFirstError($field);
                    }
                } catch (\Exception $e) {
                    $this->arrError['code'] = 203;
                    $this->arrError['data'] = $e->getMessage();
                }
            }
        }

        return $this->returnAjax();
    }

    // ajax返回
    protected function returnAjax($array = '')
    {
        // 默认赋值
        if (empty($array)) $array = $this->arrError;
        if (empty($array['msg']))
        {
            $errCode      = Yii::t('error', 'errorCode');
            $array['msg'] = $errCode[$array['code']];
        }

        if ($array['code'] <= 200) $array['status'] = 1;

        // json 返回
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $array;
    }

    // 获取model对象
    protected function getModel(){ return new Admin();}

    // 获取详情model对象
    protected function getDetailModel(){return new Admin();}
}
