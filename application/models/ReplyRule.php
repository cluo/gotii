<?php
namespace Model;
/**
 * 自动回复规则表
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class ReplyRule extends BaseModel
{
    public $id;
    public $wechat_id;
    public $title;
    public $type = "0";
    public $send_method = "0";
    
    //表名
    public function getSource()
    {
        return "wx_reply_rule";
    }
    
    public function initialize()
    {
        parent::initialize();
        $this->hasMany("id", "\Model\ReplyKeyword", "rule_id", array('alias'=>'keywords'));
    }
    
    public function validation()
    {
        //判断title是否为空
        if ($this->title == "") {
            $this->appendMessage(new \Phalcon\Mvc\Model\Message('规则名不能为空','title'));
            return false;
        }
    }
}