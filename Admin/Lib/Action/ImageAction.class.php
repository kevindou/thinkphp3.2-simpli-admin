<?php
/**
 * Class IndexAction
 * Desc: 后台图片管理页面
 * User: liujx
 * Date: 2015-1-5
 */

class ImageAction extends CommAction
{
    // 初始化定义
    public $title    = '图片信息列表';
    public $model    = 'Image';
    public $arrType  = array(1 => '游戏截图', 2 => '首页图片', 3 => '轮播图片');

    // 显示之前的处理
    public function beforeIndex($model)
    {
        // 默认赋值
        $model->arrShowTh[3]['search']['value'] = $model->arrAddTh['type']['value']      = $this->arrType;
        $model->arrShowTh[6]['search']['value'] = $model->arrAddTh['status']['value']    = $this->arrStatus;
        $model->arrShowTh[7]['search']['value'] = $model->arrAddTh['recommend']['value'] = $this->arrRecommend;
        $model->arrEditTh = $model->arrAddTh;
    }

    // 查询显示之前的处理
    public function handleValue(&$arrData, $isAll = true)
    {
        if (!$isAll) $arrData = array($arrData);
        $strWidth = $isAll ? '100px' : '100%';
        // 处理显示
        foreach ($arrData as &$mval)
        {
            $mval['createTime'] = date('Y-m-d H:i:s', $mval['createTime']);
            $mval['updateTime'] = date('Y-m-d H:i:s', $mval['updateTime']);
            $mval['status']     = $this->arrStatus[$mval['status']];
            $mval['recommend']  = $this->arrRecommend[$mval['recommend']];
            $mval['type']       = $this->arrType[$mval['type']];
            $mval['url']        = '<img src=\''.$mval['url'].'\' style=\'max-width:'.$strWidth.'\' />';
        }

        if (!$isAll) $arrData = array_shift($arrData);
    }

    // 图片上传
    public function fileUpload()
    {
        import('ORG.Net.UploadFile');                               // 引入上传文件类
        $objUpload = new UploadFile();                              // 实例化对象
        $objUpload->saveRule  = 'uniqid';                           // 上传文件名定义规则
        $objUpload->maxSize   = 200000000;                          // 允许上传2MB文件
        $objUpload->allowExts = array('jpeg', 'gif', 'png', 'jpg'); // 允许上传文件的类型
        $objUpload->savePath  = './Public/Uploads/';                // 文件保存地址
        $objUpload->autoSub   = true;                               // 上传文件子目录开启
        $objUpload->subType   = 'date';                             // 子目录命名规则
        $arrMsg = $this->arrError;                                  // 定义错误信息
        $isTrue = $objUpload->upload();                             // 执行文件上传
        $arrMsg['msg'] = $objUpload->getErrorMsg();                 // 获取上传错误信息
        if ($isTrue)
        {
            $arrMsg['msg'] = $this->strError;
            $arr    = $objUpload->getUploadFileInfo();              // 获取上传文件信息
            if (!empty($arr))
            {
                $arr = $arr[0];
                $arrMsg = array('status' => 1, 'msg' => '图片上传成功');  // 提示信息
                $arrMsg['data'] = array(                                // 返回文件信息
                    'fileName' => $arr['name'],                         // 上传文件名
                    'fileUrl'  => $arr['savepath'].$arr['savename'],    // 上传文件保存路径
                );
            }

        }

        // 返回数据
        $this->returnAjax($arrMsg);
    }
}
?>