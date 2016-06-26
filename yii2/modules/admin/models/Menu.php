<?php

namespace app\modules\admin\models;
use yii\helpers\ArrayHelper;
use app\modules\admin\widgets\OperateWidget;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property string $menu_name
 * @property string $icons
 * @property string $controller_name
 * @property string $action_name
 * @property integer $parent_id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 * @property integer $create_id
 * @property integer $update_time
 * @property integer $update_id
 */
class Menu extends \app\modules\admin\models\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'sort', 'create_time', 'create_id', 'update_time', 'update_id'], 'integer'],
            [['menu_name', 'icons', 'controller_name', 'action_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * getAlias() 获取字段的别名
     * @return array
     */
    public function getAlias()
    {
        return [
            'parent_id' => 'str_pid',
            'status'    => 'str_status',
        ];
    }

    /**
     * getLikes() 获取可以Like的字段
     * @return array
     */
    public function getLikes()
    {
        return ['menu_name'];
    }


    // jquery.dataTable 表格类信息
    public function showTableAttributes()
    {
        return [
            'id'              => ['search' => ['type' => 'text']],
            'parent_id'       => ['data' => 'str_pid'],
            'menu_name'       => [],
            'controller_name' => [],
            'action_name'     => [],
            'sort'            => [],
            'status'          => ['data' => 'str_status', 'search' => ['type' => 'select', 'value' => \Yii::$app->params['status']]],
            'create_time'     => [],
            'operate'         => ['title' => '操作', 'bSortable' => false, 'defaultContent' => OperateWidget::widget(['model' => $this])]
        ];
    }

    // 表单字段信息
    public function showFormAttributes()
    {
        // 查询分类信息
        $parents = $this->find()->select(['id', 'menu_name'])->where(['status' => 1])->all();
        $parents = ArrayHelper::map($parents, 'id', 'menu_name');
        $parents[0] = '上级导航';

        // 返回数组
        return [
            'id'              => ['type' => 'hidden'],
            'parent_id'       => ['type' => 'select', 'default' => 0, 'value' => $parents,'options' => ['required' => 1, 'number' => 1]],
            'menu_name'       => ['options' => ['required' => 1, 'rangelength' => '[2, 20]']],
            'icons'           => ['options' => ['required' => 1, 'rangelength' => '[2, 20]']],
            'controller_name' => ['options' => ['rangelength' => '[2, 20]']],
            'action_name'     => ['options' => ['rangelength' => '[2, 20]']],
            'sort'            => ['value' => 100, 'options' => ['required' => 1, 'number' => 1]],
            'status'          => ['type' => 'radio', 'default' => 1, 'value' => ['停用', '启用'], 'options' => ['required' => 1, 'number' => 1]],
        ];
    }

    private function delMenu()
    {
        $cache = \Yii::$app->cache;
        $cache->delete('arrMenu');
        $cache->delete('menu');
        return true;
    }

    /**
     * afterDelete() 删除之后执行函数
     */
    public function afterDelete()
    {
        return $this->delMenu();
    }

    /**
     * afterSave() 修改和新增之后执行函数
     */
    public function afterSave($insert, $changedAttributes)
    {
        return $this->delMenu();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'menu_name'       => '导航名称',
            'icons'           => '使用的图标',
            'controller_name' => '访问的控制器',
            'action_name'     => '访问的控制器方法名',
            'parent_id'       => '父级导航ID',
            'status'          => '导航栏的状态',
            'sort'            => '导航的排序',
            'create_time'     => '创建时间',
            'create_id'       => '创建管理员',
            'update_time'     => '修改时间',
            'update_id'       => '修改管理员',
        ];
    }
}
