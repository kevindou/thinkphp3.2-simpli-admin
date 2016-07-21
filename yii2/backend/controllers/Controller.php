<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\Admin;
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
    public    $enableCsrfValidation = false, $admins = null;    // 'enableCsrfValidation' => true // 配置文件关闭CSRF
    protected $sort                 = 'id';                     // 默认排序字段

    // 定义响应请求的返回数据
    public $arrError = [
        'code'   => 201,
        'msg'    => '',
        'status' => 0,
        'data'   => [],
    ];

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
        Yii::$app->view->params['menus'] = $menus;
        return true;
    }

    // 初始化处理函数
    public function init()
    {
        parent::init();
        // 查询后台管理员信息
        $admin = Admin::find()->select(['id', 'username'])->all();
        $this->admins = ArrayHelper::map($admin, 'id', 'username');
        // 注入变量信息
        Yii::$app->view->params['admins'] = $this->admins;
    }

    // 首页显示
    public function actionIndex() { return $this->render('index'); }

    /**
     * where() 获取查询的配置信息(查询参数)
     * @access protected
     * @param  array $params 查询的请求参数
     * @return array 返回一个数组用来查询
     */
    protected function where($params)
    {
        return [];
    }

    // 处理查询信息
    protected function query()
    {
        $request = Yii::$app->request;
        $params  = $request->post('params');                    // 接收查询参数
        $sort    = $request->post('sSortDir_0', 'asc');         // 排序方式
        $sort    = $sort == 'asc' ? SORT_ASC : SORT_DESC;       // 排序方式

        // 接收参数
        $aWhere  = $this->where($params);                       // 查询配置信息
        $sFile   = isset($params['orderBy']) && ! empty($params['orderBy']) ? $params['orderBy'] : $this->sort; // 排序字段
        $aSearch = [
            'orderBy' => [$sFile => $sort],                     // 默认排序方式
            'where'   => [],                                    // 查询条件
            'offset'  => $request->post('iDisplayStart',  0),   // 查询开始位置
            'limit'   => $request->post('iDisplayLength', 10),  // 查询数据条数
            'echo'    => $request->post('sEcho',          1),   // 查询次数
        ];

        // 自定义了排序
        if ( ! empty($aWhere) && isset($aWhere['orderBy']) && ! empty($aWhere['orderBy']))
        {
            // 判断自定义排序字段还是方式
            $aSearch['orderBy'] = is_array($aWhere['orderBy']) ? $aSearch['orderBy'] : [$aSearch['orderBy'] => $sort];
            unset($aWhere['orderBy']);
        }

        // 处理默认查询条件
        if ( ! empty($aWhere) && isset($aWhere['where']) && ! empty($aWhere['where']))
        {
            $aSearch['where'] = array_merge($aSearch['where'], $aWhere['where']);
            unset($aWhere['where']);
        }

        // 处理其他查询条件
        if ( ! empty($aWhere) && ! empty($params))
        {
            foreach ($params as $key => $value)
            {
                if ( ! isset($aWhere[$key])) continue;
                $tmpKey = $aWhere[$key];
                $aSearch['where'][] = is_array($tmpKey) ? $tmpKey : [$tmpKey, $key, $value];
            }
        }

        // 添加查询条件
        if ( ! empty($aSearch['where'])) array_unshift($aSearch['where'], 'and');
        return $aSearch;
    }

    /**
     * afterSearch() 查询之后的数据处理函数
     * @access protected
     * @param  mixed $array 查询出来的数组对象
     * @return void  对数据进行处理
     */
    protected function afterSearch(&$array){}

    // 查询方法
    public function actionSearch()
    {
        // 定义请求数据
        if (Yii::$app->request->isAjax)
        {
            $arrSearch = $this->query();                          // 处理查询参数
            $objQuery  = $this->getModel()->find()->where($arrSearch['where']);

            // 查询之前的处理
            $objMod    = clone $objQuery;
            $intTotal  = $objMod->count();                        // 查询数据条数
            $arrObject = $objQuery->offset($arrSearch['offset'])->limit($arrSearch['limit'])->orderBy($arrSearch['orderBy'])->all();
            if ($arrObject) $this->afterSearch($arrObject);

            // 返回数据
            $this->arrError = [
                'code'  => 2,
                'other' => $objQuery->offset($arrSearch['offset'])->limit($arrSearch['limit'])->orderBy($arrSearch['orderBy'])->createCommand()->getRawSql(),
                'data'  => [
                    'sEcho'                => $arrSearch['echo'],     // 查询次数
                    'iTotalRecords'        => count($arrObject),      // 本次查询数据条数
                    'iTotalDisplayRecords' => $intTotal,              // 数据总条数
                    'aaData'               => $arrObject,             // 本次查询数据信息
                ]
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
            $this->arrError['code'] = 207;
            if ($type)
            {
                $data   = $request->post();
                $model  = $this->getModel();
                $index  = $model->primaryKey();
                $isTrue = false;
                unset($data['actionType']);

                // 删除全部
                if ($type === 'deleteAll' && isset($data['ids']) && ! empty($data['ids']))
                {
                    // 判断是否有删除全部的权限
                    $this->arrError['code'] = 216;
                    if (Yii::$app->user->can(Yii::$app->controller->id.'/deleteAll'))
                    {
                        $isTrue = $model->deleteAll([$index[0] => explode(',', $data['ids'])]);
                    }
                }
                else
                {
                    // 修改和删除时的查询数据
                    if ($type == 'update' || $type == 'delete') $model = $model->findOne($data[$index[0]]);

                    // 删除数据
                    if ($type == 'delete')
                    {
                        $this->arrError['code'] = 206;
                        $isTrue = $model->delete();
                    }
                    else
                    {
                        // 新增数据
                        $this->arrError['code'] = 205;
                        $isTrue = $model->load(['params' => $data], 'params');
                        if ($isTrue)
                        {
                            $isTrue = $model->save();
                            $this->arrError['msg'] = $model->getErrorString();
                        }
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

    // 行内编辑
    public function actionEditable()
    {
        $request = Yii::$app->request;
        if ($request->isAjax)
        {
            // 接收参数
            $mixPk    = $request->post('pk');    // 主键值
            $strAttr  = $request->post('name');  // 字段名
            $mixValue = $request->post('value'); // 字段值
            $this->arrError['code'] = 207;
            if ($mixPk && $strAttr  && $mixValue != '')
            {
                // 查询到数据
                $model = $this->getModel()->findOne($mixPk);
                $this->arrError['code'] = 220;
                if ($model)
                {
                    $model->$strAttr = $mixValue;
                    $this->arrError['code'] = 206;
                    if ($model->save())
                    {
                        $this->arrError['code'] = 0;
                        $this->arrError['data'] = $model;
                    }
                }
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
        if ($request->isPost)
        {
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
        if (empty($array)) $array = $this->arrError;                    // 默认赋值
        if ( ! isset($array['msg']) || empty($array['msg']))
        {
            $errCode      = Yii::t('error', 'errorCode');
            $array['msg'] = $errCode[$array['code']];
        }

        if ($array['code'] <= 200) $array['status'] = 1;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;   // json 返回
        return $array;
    }

    // 获取model对象
    protected function getModel(){ return new Admin();}

    // 获取详情model对象
    protected function getDetailModel(){return new Admin();}
}
