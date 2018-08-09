<?php
/**
 * file: Controller.class.php
 * desc: 后台公共控制器
 * user: liujx
 * date: 2016-3-12
 */

namespace Admin\Controller;

use Common\Auth;

class Controller extends \Common\Controller
{
    // 定义验证数据、模型、主键
    protected $validate = [], $model = 'admin', $pk = 'id', $thumb = [160, 160], $sort = 'id';

    // 初始化判断定义
    public function _initialize()
    {
        // 判断是否已经登录
        parent::_initialize();

        // 不是管理员需要验证权限
        if ($this->user->id !== 1) {
            // 验证用户权限
            if (!Auth::can($this->user->id, strtolower('/' . MODULE_NAME . '/' . CONTROLLER_NAME) . '/' . ACTION_NAME)) {
                $strMsg = '抱歉！你没有执行权限 :)';
                IS_AJAX ? $this->ajaxReturn($strMsg) : $this->go($strMsg);
            }
        }
    }

    // 获取数据页面
    public function index()
    {
        $this->display();
    }

    // 查询处理
    protected function query()
    {
        // 接收参数
        $aParams = post('params');                   // 查询参数
        $sOrder  = post('sSortDir_0', 'desc');       // 排序类型
        if (method_exists($this, 'where')) {
            $aWhere = $this->where($aParams);           // 查询条件信息
        } else {
            $aWhere = [];
        }

        $sFile   = isset($aParams['orderBy']) && !empty($aParams['orderBy']) ? $aParams['orderBy'] : $this->sort; // 排序字段
        $aSearch = [
            'orderBy' => [$sFile => $sOrder],
            'where'   => [],                         // 查询条件
        ];

        // 自定义了排序
        if (!empty($aWhere) && isset($aWhere['orderBy']) && !empty($aWhere['orderBy'])) {
            // 判断自定义排序字段还是方式
            $aSearch['orderBy'] = is_array($aWhere['orderBy']) ? $aSearch['orderBy'] : [$aSearch['orderBy'] => $sOrder];
            unset($aWhere['orderBy']);
        }

        // 处理默认查询条件
        if (!empty($aWhere) && isset($aWhere['where']) && !empty($aWhere['where'])) {
            $aSearch['where'] = array_merge($aSearch['where'], $aWhere['where']);
            unset($aWhere['where']);
        }

        // 处理其他查询条件
        if (!empty($aParams) && !empty($aWhere)) {
            foreach ($aParams as $key => $value) {
                if (!isset($aWhere[$key])) continue;
                $tmpKey = $aWhere[$key];
                if (is_array($tmpKey))
                    $aSearch['where'][$key] = $tmpKey;
                else {
                    if ($tmpKey == 'like') $value = "%{$value}%";
                    $aSearch['where'][$key] = [$tmpKey, $value];
                }
            }
        }

        return $aSearch;
    }

    // 查询所有数据
    public function search()
    {
        // 接收参数
        $intNum  = (int)post('sEcho');               // 第几页
        $start   = (int)post('iDisplayStart', 0);   // 开始位置
        $length  = (int)post('iDisplayLength', 10);  // 查询长度
        $aSearch = $this->query();

        // 查询数据
        /* @var $query mixed */
        $query = M($this->model)->where($aSearch['where']);
        $model = clone $query;
        $count = $query->count();
        $data  = $model->limit($start, $length)->order($aSearch['orderBy'])->select();

        $this->ajaxSuccess([
            'sEcho'                => $intNum,      // 请求次数
            'iTotalRecords'        => count($data), // 当前页面条数
            'iTotalDisplayRecords' => (int)$count,  // 数据总条数
            'aaData'               => $data,        // 数据信息
        ]);
    }

    public function insert()
    {
        // 数据验证
        /* @var $model mixed */
        $model = D($this->model);
        if (!$model->validate($this->validate)->create()) {
            $this->ajaxError($model->getError());
        }

        if (!$this->beforeInsert($model)) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        if (!$insert_id = $model->add()) {
            $this->ajaxError('新增数据失败');
        }

        $data = $model->find($insert_id);
        if (method_exists($this, 'afterSave') && !$this->afterSave($data, post(), 'insert')) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        return $this->ajaxSuccess($data, '新增成功');
    }

    public function delete()
    {
        // 验证数据存在
        $id = post($this->pk);
        if (!$data = M($this->model)->find($id)) {
            $this->ajaxError('删除数据不存在');
        }

        // 如果是管理员删除 验证权限
        if (CONTROLLER_NAME == 'Admin' &&
            $this->user->id != 1 &&
            !Auth::can($this->user->id, 'deleteUser') &&
            post('create_id') != $this->user->id) {
            $this->ajaxError('你没有权限操作');
        }

        // 前置操作
        if (method_exists($this, 'beforeDelete') && !$this->beforeDelete($data)) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        if (!M($this->model)->delete($id)) {
            $this->ajaxError('删除成功失败');
        }

        // 后置操作
        if (method_exists($this, 'afterSave') && !$this->afterSave($data, post(), 'delete')) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        return $this->ajaxSuccess($data, '删除成功');
    }

    // 修改数据
    public function update()
    {
        // 验证数据存在
        if (!$data = M($this->model)->find(post($this->pk))) {
            $this->ajaxError('修改数据不存在');
        }

        // 数据验证
        /* @var $model mixed */
        $model = D($this->model);
        if (!$model->validate($this->validate)->create()) {
            $this->ajaxError($model->getError());
        }

        if (!$this->beforeUpdate($model)) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        if (!$model->save()) {
            $this->ajaxError('修改失败');
        }

        if (method_exists($this, 'afterSave') && !$this->afterSave($data, post(), 'update')) {
            $this->ajaxError('服务器繁忙,请稍候再试...');
        }

        return $this->ajaxSuccess($data, '修改成功');
    }

    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function export()
    {
        // 接收参数
        $arrFields = post('aFields');       // 字段信息
        $strTitle  = post('sTitle');        // 标题信息

        // 数据验证
        if (IS_POST && $arrFields && $strTitle) {
            // 查询信息
            $aSearch = $this->query();
            $arrKeys = array_keys($arrFields); // 所有的字段
            // 查询数据
            $objQuery              = M($this->model)->field($arrKeys)->where($aSearch['where']);
            $data                  = $objQuery->select();
            $this->arrError['msg'] = '没有需要导出的数据';
            if ($data) {
                // 1 引入phpExcel类
                import('Org.Util.PHPExcel'); // 没有命名空间使用 import 引入
                set_time_limit(0);
                ob_end_clean();
                ob_start();

                // 实例化一个phpExcel类
                $objPHPExcel = new \PHPExcel();
                $objPHPExcel->getProperties()->setCreator("Liujx Admin")
                    ->setLastModifiedBy("Liujx Admin")
                    ->setTitle("Office 2007 XLSX Test Document")
                    ->setSubject("Office 2007 XLSX Test Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("Test result file");
                $objPHPExcel->setActiveSheetIndex(0);

                // 获取显示列的信息
                $letter  = 'A';
                $letters = [];
                foreach ($arrFields as $attributes => $value) {
                    $letters[$letter] = $attributes;
                    $objPHPExcel->getActiveSheet()->setCellValue($letter . '1', $value);
                    $letter++;
                }

                // 写入数据信息
                $intNum = 2;
                foreach ($data as $value) {
                    // 写入信息数据
                    foreach ($letters as $letter => $attributes) {
                        $tmp_value = isset($value[$attributes]) ? $value[$attributes] : '';
                        $objPHPExcel->getActiveSheet()->setCellValue($letter . $intNum, $tmp_value);
                    }

                    $intNum++;
                }

                // 设置sheet 标题信息
                $objPHPExcel->getActiveSheet()->setTitle($strTitle);
                // 设置头信息
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $strTitle . '.xlsx"');
                header('Cache-Control: max-age=0');
                header('Cache-Control: max-age=1');
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0

                // 直接输出文件
                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                return;
            }
        }

        $this->redirect('index');
    }

    /**
     * beforeUpload() 文件上传之前 对文件的一些验证
     * @access protected
     * @return object 返回上传对象
     */
    protected function beforeUpload()
    {
        // 接收上传文件信息
        $upload           = new \Think\Upload();                     // 实例化上传文件类
        $upload->maxSize  = 1048576;                       // 上传文件大小
        $upload->exts     = ['jpg', 'gif', 'png', 'jpeg']; // 上传文件类型
        $upload->rootPath = './Public/Uploads/';           // 上传文件保存的根目录
        $upload->subName  = ['date', 'Ymd'];               // 上传保存子目录
        $upload->saveName = ['uniqid', CONTROLLER_NAME];   // 文件名称
        return $upload;
    }

    // 文件上传
    public function upload()
    {
        // 删除图片处理
        $strOldName = get('sOldName');
        if ($strOldName && file_exists('.' . $strOldName)) {
            @unlink('.' . $strOldName);
        }

        // 获取上传对象
        $upload = $this->beforeUpload();
        if (!$info = $upload->upload()) {
            $this->ajaxError($upload->getError());
        }

        if (method_exists($this, 'afterUpload') && !$this->afterUpload($info)) {
            $this->ajaxError('上传文件处理失败');
        }

        $arrInfo = [];
        foreach ($info as $value) {
            $arrInfo[] = [
                'sOldName' => $value['name'],                                           // 旧文件名
                'sNewName' => $value['savename'],                                       // 新文件名
                'sPath'    => trim($upload->rootPath, '.') . $value['savepath'] . $value['savename'], // 文件路径
            ];
        }

        $this->ajaxSuccess($arrInfo, '文件上传成功');
    }

// 图片裁剪
    public function clipping()
    {
        $intX    = (int)post('x');  // x轴
        $intY    = (int)post('y');  // y轴
        $intW    = (int)post('w');  // 宽度
        $intH    = (int)post('h');  // 高度
        $strPath = post('path');    // 图片路径
        if (empty($strPath) || (empty($intX) && empty($intY) && empty($intW) && empty($intH))) {
            $this->ajaxError('请求数据存在问题');
        }

        // 判读图片存在
        $strPath = '.' . trim($strPath, '.');
        if (!file_exists($strPath)) {
            $this->ajaxError('处理图片不存在');
        }

        $image = new \Think\Image();
        $image->open($strPath);

        if (!$image->crop($intW, $intH, $intX, $intY)->save($strPath)) {
            $this->ajaxError('图片裁剪失败');
        }

        $image->open($strPath);
        if (!$image->thumb($this->thumb[0], $this->thumb[1], \Think\Image::IMAGE_THUMB_SCALE)->save($strPath)) {
            $this->ajaxError('图片缩放失败');
        }

        $this->ajaxSuccess(trim($strPath, '.'), '图片裁剪成功');
    }

    // 新增之前的处理
    protected function beforeInsert(&$model)
    {
        $model->update_id   = $model->create_id = $this->user->id;
        $model->update_time = $model->create_time = time();
        return true;
    }

    // 修改之前的处理
    protected function beforeUpdate(&$model)
    {
        $model->update_id   = $this->user->id;
        $model->update_time = time();
        return true;
    }
}