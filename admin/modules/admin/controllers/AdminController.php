<?php

namespace app\modules\admin\controllers;
use app\modules\admin\models\Admin;
use yii\data\Pagination;

class AdminController extends Controller
{
    public $title = '管理员信息';

    /**
     * actionIndex() 首页显示
     * @return string
     */
    public function actionIndex()
    {
        $model = new Admin();
        return $this->render('/layouts/jqGrid', $this->setColModel($model->showColModel(), $model->attributeLabels()));
    }

    /**
     * actionGetData() 获取数据信息
     */
    public function actionGetData()
    {
        // 接收参数
        $request   = \Yii::$app->request;
        $int_rows  = (int)$request->get('rows', 10);    // 每页数量
        $int_page  = (int)$request->get('page');        // 第几页
        $str_sort  = $request->get('sidx', 'id');       // 排序字段
        $str_sort  = empty($str_order) ? 'id' : $str_order;
        $str_order = $request->get('sord');             // 排序方式
        $filters   = $request->get('filters');          // 查询字段
        $is_search = $request->get('_search');          // 是否查询

        // 判断查询条件
        $where     = [];
        if (! empty($filters) && ! empty($is_search))
        {
            $arr_search = json_decode($filters, true);
            if (! empty($arr_search['rules']))
            {
                $where[] = strtolower($arr_search['groupOp']);
                foreach ($arr_search['rules'] as $str_value)
                {
                    // 判断类型
                    switch ($str_value['op'])
                    {
                        case 'eq' : $where[] = ['=', $str_value['field'], $str_value['data']];                      break;  // 等于
                        case 'ne' : $where[] = ['!=', $str_value['field'], $str_value['data']];                     break;  // 不等于
                        case 'bw' : $where[] = ['>', $str_value['field'], $str_value['data']];                      break;  // 开始于
                        case 'bn' : $where[] = ['<=', $str_value['field'], $str_value['data']];                     break;  // 不开始于
                        case 'ew' : $where[] = ['<', $str_value['field'], $str_value['data']];                      break;  // 结束于
                        case 'en' : $where[] = ['>=', $str_value['field'], $str_value['data']];                     break;  // 不结束于
                        case 'cn' : $where[] = ['like', $str_value['field'], $str_value['data']];                   break;  // 包含
                        case 'nc' : $where[] = ['not like', $str_value['field'], $str_value['data']];               break;  // 不包含
                        case 'nu' : $where[] = ['is', $str_value['field'], null];                                   break;  // 不存在
                        case 'nn' : $where[] = ['is not', $str_value['field'], null];                               break;  // 存在
                        case 'in' : $where[] = ['in', $str_value['field'], explode(',', $str_value['data'])];       break;  // 属于
                        case 'ni' : $where[] = ['not in', $str_value['field'], explode(',', $str_value['data'])];   break;  // 不属于
                    }
                }
            }
        }

        // 查询数据的总条数
        $query      = Admin::find()->where($where);
        $countQuery = clone $query;
        $int_total  = $countQuery->count();

        // 分页查询
        $pages      = new Pagination([
            'totalCount' => $int_total,
            'pageSize'   => $int_rows,
        ]);

        $data       = $query->offset($pages->offset)->limit($pages->limit)->orderBy([$str_sort => $str_order])->all();
//        echo $query->createCommand()->getRawSql();

        // ajax返回
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return  [
            'rows'    => $data,                        // 数据信息
            'total'   => (int)$int_total,           // 总数据数
            'page'    => $int_page,                 // 当前页
            'records' => count($data),              // 查询数据条数
        ];
    }

    /**
     * setColModel() 生成jqGrid() 需要的列信息和字段信息
     * @param array $arrData 需要处理生成的数据
     * @
     */
    public function setColModel($arrData, $attribute = array())
    {
        $colNames = array();    // 显示列名
        $colModel = array();    // 显示列信息
        if ($arrData)
        {
            $colNames[] = '操作';
            // 默认添加列
            $colModel[] = array(
                'name'      => 'myac',
                'width'     => 80,
                'fixed'     => true,
                'sortable'  => false,
                'resize'    => false,
                'formatter' => 'actions',
                'formatoptions' => array(
                    'delOptions' => array(
                        'recreateForm'   => 'true',
                        'beforeShowForm' => 'beforeDeleteCallback'
                    ),
                )

            );

            // 处理数据据
            foreach ($arrData as $key => $value)
            {
                $colNames[] = $attribute[$key];
                $colModel[] = array_merge(array('name' => $key, 'index' => $key, 'editable' => true), $value);
            }
        }

        return array(
            'colNames' => json_encode($colNames),
            'colModel' => json_encode($colModel),
        );
    }
}
