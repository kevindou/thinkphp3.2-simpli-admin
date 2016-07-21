<?php
namespace backend\models;
/**
 * Class    UploadForm
 * @package backend\models
 * @Desc    文件上传类
 * @User    liujx
 * @Date    2016-4-7
 */
class UploadForm extends \yii\base\Model
{
    // 定义字段
    public $share_img;
    public $gift_img;
    public $push;
    public $phone;
    // 设置应用场景
    public function scenarios()
    {
        return [
            'share_img' => ['share_img'],
            'gift_img'  => ['gift_img'],
            'push'  => ['push'],
            'phone'  => ['phone']
        ];
    }

    // 验证规则
    public function rules()
    {
        return [
            [['share_img'], 'image', 'extensions' => ['png', 'jpg', 'gif', 'jpeg'], 'maxWidth' => 530, 'maxHeight' => 300, 'on' => 'share_img'],
            [['gift_img'], 'file', 'on' => 'gift_img'],
            [['push'], 'file', 'on' => 'push'],
            [['phone'], 'file',  'on' => 'phone']
        ];
    }
}