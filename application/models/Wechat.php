<?php
namespace Model;
use Phalcon\Mvc\Model\Validator;
/**
 * 公众号信息模型
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class Wechat extends BaseModel
{
    public $name;
    public $token;
    public $type = '0';
    public $verified = '0';
    public $appid = '';
    public $appsecret = '';
    public $avatar = '';
    
    public function onConstruct()
    {
        $this->skipAttributesOnUpdate(array('token'));
    }
    public function getSource()
    {
        return "wx_wechat";
    }
    
    public function validation()
    {
        $this->validate(new \Model\Validator\Utf8Strlen(array(
            'field' => 'name',
            'max' => '13',
            'min' => '1',
            'messageMaximum' => '公众号名称最多13个字',
            'messageMinimum' => '公众号不能为空'
        )));
        
        return $this->validationHasFailed() == false;
    }
}