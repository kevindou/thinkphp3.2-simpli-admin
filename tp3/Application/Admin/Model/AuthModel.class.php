<?php
/**
 * Created by PhpStorm.
 * User: liujinxing
 * Date: 2016/6/27
 * Time: 14:48
 */

namespace Admin\Model;

use Think\Model;
use Common\Helper;

class AuthModel extends Model
{
    const ROLE_TYPE = 1;
    const AUTH_TYPE = 2;

    // 表名字
    protected $tableName = 'auth_item';

    // 数据验证
    protected $_validate = [
        ['name', 'require', '名称不能为空'],
        ['name', '2,50', '长度必须为2到50个字符', 1, 'length'],
        ['desc', 'require', '说明不能为空'],
        ['desc', '2, 255', '长度必须为2到255个字符', 1, 'length']
    ];

    /**
     * handleItem() 处理数据信息
     * @param  string $sType        操作类型('insert', 'update', 'delete')
     * @param  int    $iType        数据类型 1 role 2 auth
     * @return bool|mixed|string    操作成功返回true insertId 或者错误字符串
     */
    public function handleItem($sType, $iType)
    {
        $maxData = $this->create();
        if (false !== $maxData)
        {
            switch ($sType)
            {
                case 'insert': $isTrue = $this->createItem($maxData['name'], $this->desc, $iType);   break;
                case 'update': $isTrue = $this->updateItem($maxData['name'], $this->desc);           break;
                default:       $isTrue = $this->deleteItem($maxData['name'], $iType);
            }

        }
        else
            $isTrue = $this->getError();

        return $isTrue;
    }

    /**
     * createItem()新增数据信息
     * @param  string $name   名称
     * @param  string $desc   说明
     * @param  int    $iType  类型 1 role 2 auth
     * @return bool|mixed     成功返回 insert_id 失败返回false 或者错误字符串
     */
    public function createItem($name, $desc, $iType)
    {
        // 添加数据
        return $this->add([
            'name' => $name,
            'desc' => $desc,
            'type' => $iType,
        ]) ? ($iType === AuthModel::AUTH_TYPE ? $this->addRolePower('admin', $name) : true) : false;
    }

    /**
     * updateItem() 修改数据
     * @param  string $name 名称
     * @param  string $desc 说明
     * @return bool   成功返回 true
     */
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
    public static function addRolePower($role, $auth)
    {
        return M('auth_child')->add(['parent' => $role, 'child' => $auth]);
    }

    // 判断用户是否有权限
    public static function can($intUid, $items)
    {
        $arrItems = self::getUserItems($intUid);
        return $arrItems && isset($arrItems[$items]);
    }

    // 根据用户获取角色
    public static function getUserRoles($intUid)
    {
        // 判断是否为管理员
        $where = ['type' => ['eq', AuthModel::ROLE_TYPE]];
        if ($intUid !== 1) {
            $where = ['name' => ''];
            $arrPowers = M('admin')->field(['roles'])->where(['id' => $intUid])->find();
            if (false !== $arrPowers && ! empty($arrPowers['roles'])) $where['name'] = ['in', $arrPowers['roles']];
        }

        $arrPowers = M('auth_item')->field(['name', 'desc'])->where($where)->select(['index' => 'name']);
        return Helper::map($arrPowers, 'name', 'desc');
    }

    // 获取角色对应的权限信息
    public static function getRoleItems($name)
    {
        $arrPowers = M('auth_child')->where(['parent' => $name])->select();
        return Helper::map($arrPowers, 'child', 'parent');
    }

    // 获取用户的权限信息
    public static function getUserItems($intUid)
    {
        $arrRoles  = self::getUserRoles($intUid);
        $arrPowers = [];
        if ($arrRoles) foreach ($arrRoles as $key => $value) $arrPowers = array_merge($arrPowers, self::getRoleItems($key));
        return $arrPowers;
    }

    // 根据权限获取导航栏信息
    public static function getUserMenus($intUid)
    {
        // 获取用户权限
        $arrPowers = self::getUserItems($intUid);
        $arrMenus  = $arrParents = $arrAllMenus =  [];
        $objModel  = M('menu');

        // 查询栏目数据
        if ($arrPowers) $arrMenus  = $objModel->field(['id', 'pid', 'menu_name', 'icons', 'url'])->where(['url' => ['in', array_keys($arrPowers)]])->order(['sort' => 'asc'])->select();
        if ($arrMenus)
        {
            foreach ($arrMenus as $value) if ($value['pid'] != 0) $arrParents[] = (int)$value['pid'];
            // 查询父类
            if ($arrParents)
            {
                $arrParents = $objModel->field(['id', 'pid', 'menu_name', 'icons', 'url'])->where(['id' => ['in', array_unique($arrParents)]])->order(['sort' => 'asc'])->select();
                if ($arrParents) $arrMenus = array_merge($arrMenus, $arrParents);
            }
        }

        // 处理栏目数据
        if ($arrMenus)
        {
            foreach ($arrMenus as $key => $value)
            {
                $pid = $value['pid'];
                $id  = $value['id'];
                if ($pid == 0) {
                    // 一级栏目
                    if(isset($arrAllMenus[$id])) $value['child'] =  $arrAllMenus[$id]['child'];
                    $arrAllMenus[$id] = $value;
                } else {
                    // 不存在创建父类数组
                    if (!isset($arrAllMenus[$pid])) $arrAllMenus[$pid] = array();
                    $arrAllMenus[$pid]['child'][] = $value;
                }
            }
        }

        return $arrAllMenus;
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