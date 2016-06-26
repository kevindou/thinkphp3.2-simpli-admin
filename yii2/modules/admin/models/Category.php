<?php

namespace app\modules\admin\models;
use yii\helpers\ArrayHelper;
use app\modules\admin\widgets\OperateWidget;
use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $path
 * @property string $cate_name
 * @property integer $sort
 * @property integer $recommend
 * @property integer $status
 * @property integer $create_time
 * @property integer $create_id
 * @property integer $update_time
 * @property integer $update_id
 */
class Category extends \app\modules\admin\models\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * getLikes() 获取可以Like的字段
     * @return array
     */
    public function getLikes()
    {
        return ['cate_name'];
    }

    /**
     * getAlias() 获取字段的别名
     * @return array
     */
    public function getAlias()
    {
        return [
            'pid'       => 'str_pid',
            'status'    => 'str_status',
            'recommend' => 'str_recommend'
        ];
    }

    // jquery.dataTable 表格类信息
    public function showTableAttributes()
    {
        return [
            'id'          => ['search' => []],
            'pid'         => ['data' => 'str_pid'],
            'cate_name'   => [],
            'sort'        => [],
            'recommend'   => ['data' => 'str_recommend', 'search' => ['type' => 'select', 'value' => \Yii::$app->params['recommend']]],
            'status'      => ['data' => 'str_status', 'search' => ['type' => 'select', 'value' => \Yii::$app->params['status']]],
            'create_time' => [],
            'operate'     => ['title' => '操作', 'bSortable' => false, 'defaultContent' => OperateWidget::widget(['model' => $this])]
        ];
    }

    // 表单字段信息
    public function showFormAttributes()
    {
        // 查询所有一级分类
        $arrParent    = ArrayHelper::map($this->find()->select(['id', 'cate_name'])->where(['pid' => 0])->all(), 'id', 'cate_name');
        $arrParent[0] = '父级分类';
        return [
            'id'        => ['type' => 'hidden'],
            'pid'       => ['type' => 'select', 'default' => 0, 'value' => $arrParent,'options' => array('required' => 1, 'number' => 1)],
            'cate_name' => ['options' => ['required' => 1, 'rangelength' => '[2, 12]']],
            'sort'      => ['options' => ['required' => 1, 'number' => 1]],
            'recommend' => ['type' => 'radio', 'default' => 0, 'value' => ['不推荐', '推荐'], 'options' => ['required' => 1, 'number' => 1]],
            'status'    => ['type' => 'radio', 'default' => 1, 'value' => ['停用', '启用'], 'options' => ['required' => 1, 'number' => 1]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort', 'recommend', 'status', 'create_time', 'create_id', 'update_time', 'update_id'], 'integer'],
            [['cate_name'], 'required'],
            [['path', 'cate_name'], 'string', 'max' => 255]
        ];
    }

    public function beforeSave($insert)
    {
        $time  = time();
        $admin = \Yii::$app->session->get(\Yii::$app->params['session_admin']);
        if ($insert)
        {
            $this->create_time = $time;
            $this->create_id   = $admin['id'];
        }

        $this->update_id   = $admin['id'];
        $this->update_time = $time;
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => '分类ID',
            'pid'         => '父类ID',
            'path'        => '分类路径',
            'cate_name'   => '分类名称',
            'sort'        => '分类排序',
            'recommend'   => '是否为推荐',
            'status'      => '分类状态',
            'create_time' => '创建时间',
            'create_id'   => '创建用户',
            'update_time' => '修改时间',
            'update_id'   => '修改者',
        ];
    }
}
