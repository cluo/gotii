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
    
    //表名
    public function getSource()
    {
        return "wx_wechat";
    }
    
    //只在第一次实例化的时候执行
    public function initialize()
    {
        parent::initialize();
        $this->hasManyToMany("id", "\Model\WechatUser", "wechat_id", "uid", "\Model\User", "id", array("alias"=>"users"));
    }
    
    //每次实例化都执行
    public function onConstruct()
    {
        $this->skipAttributesOnUpdate(array('token'));
    }
    
    //验证数据
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