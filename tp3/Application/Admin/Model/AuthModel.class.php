<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2016/6/27
 * Time: 14:48
 */

namespace Admin\Model;

use Think\Model;

class AuthModel extends Model
{
    const ROLE_TYPE = 1;
    const AUTH_TYPE = 2;

    // 表名字
    protected $tableName = 'auth_item';

    // 设置主键
    protected $pk        = 'name';

    // 数据验证
    protected $_validate = [
        ['name', 'require', '名称不能为空'],
        ['name', '2,50', '长度必须为2到50个字符', 1, 'length'],
        ['name', '', '名称必须唯一', 1, 'unique'],
        ['desc', 'require', '说明不能为空'],
        ['desc', '2, 255', '长度必须为2到255个字符', 1, 'length']
    ];

    // 创建数据信息
    public function handleItem($sType, $iType)
    {
        if ($this->create())
        {
            switch ($sType)
            {
                case 'insert': $isTrue = $this->createItem($this->name, $this->desc, $iType);   break;
                case 'update': $isTrue = $this->updateItem($this->name, $this->desc);           break;
                default:       $isTrue = $this->deleteItem($this->name, $iType);
            }

        }
        else
            $isTrue = $this->getError();

        return $isTrue;
    }

    // 新增数据
    public function createItem($name, $desc, $iType)
    {
        $aInsert = [
            'name' => $name,
            'desc' => $desc,
            'type' => $iType,
        ];

        // 添加数据
        return $this->add() ? ($iType === AuthModel::AUTH_TYPE ? $this->addRolePower('admin', $name) : true) : false;
    }

    // 修改数据
    public function updateItem($name, $desc)
    {
        return $this->where(['name' => $name])->save(['desc' => $desc]);
    }

    // 删除数据
    public function deleteItem($name, $iType)
    {
        return ($iType === AuthModel::ROLE_TYPE
            &&
            (M('auth_child')->where(['parent' => $name])->count()) > 0)
            ? '这个角色正在使用,不能删除' : ($this->where(['name' => $name])->delete());
    }

    // 添加给角色添加权限
    public function addRolePower($role, $auth)
    {
        return M('auth_child')->add(['parent' => $role, 'child' => $auth]);
    }

    // 数据新增之前
    protected function _before_insert(&$data, $options)
    {
        $data['create_time'] = $data['update_time'] = time();
        return true;
    }

    // 数据修改之前
    protected function _before_update(&$data, $options)
    {
        $data['update_time'] = time();
        return true;
    }

}