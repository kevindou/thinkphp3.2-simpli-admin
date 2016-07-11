<?php
/**
 * file: 后台管理员页面
 */

// 引入命名空间
namespace Admin\Controller;

use Common\Auth;

// 引入命名空间
class AdminController extends Controller
{
    // 定义查询数据
    public $model = 'admin';
    public function where($params)
    {
        // 默认查询
        $where = [
            'id'      => 'eq',
            'status'  => 'eq',
            'email'   => 'like',
        ];

        // 不是管理员只能看到自己和自己添加的用户
        if ($this->user->id !== 1)
        {
            $where['where']['_complex'] = [
                'id'        => ['eq', $this->user->id],
                'create_id' => ['eq', $this->user->id],
                '_logic'    => 'or',
            ];
        }

        return $where;
    }

    // 显示进入首页
    public function login()
    {
        // 角色信息
        $roles = Auth::getUserRoles($this->user->id);
        $roles = empty($roles) ? ($this->user->id == 1 ? '超级管理员' : '普通游客') : implode(',', $roles);

        $this->render('Admin/index', [
            'roles' => $roles,
            'user'  => $_SESSION[$this->_admin],
        ]);
    }

    // 首页显示
    public function index()
    {
        $this->render('Admin/admin', ['roles' => Auth::getUserRoles($this->user->id)]);
    }

    // 新增之前的处理
    public function beforeInsert(&$model)
    {
        $model->roles       = post('roles') ? implode(',', post('roles')) : '';
        $model->password    = sha1($model->password);
        $model->create_time = $model->update_time = $model->last_time = time();
        $model->create_id   = $model->update_id   = $this->user->id;
        $model->last_ip     = get_client_ip();
        return true;
    }

    // 修改之前的处理
    public function beforeUpdate(&$model)
    {
        $model->roles = post('roles') ? implode(',', post('roles')) : '';
        if (empty($model->password))
            unset($model->password);
        else
           $model->password = sha1($model->password);
        return true;
    }

    // 修改之后的处理
    public function afterSave($old, $new, $type)
    {
        if (isset($new['face']) && ! empty($new['face'])) $_SESSION[$this->_admin]['face'] = $new['face'];
        return true;
    }

    // 上传图片之后的处理
    public function afterUpload($info)
    {
        $path = '/Public/Uploads/'.$info['file']['savepath'].$info['file']['savename'];
        if (M('admin')->where(['id' => $this->user->id])->save(['face' => $path])) $_SESSION[$this->_admin]['face'] = $path;
        return true;
    }
}