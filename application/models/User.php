<?php
namespace Model;
/**
 * 用户账户模型
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class User extends BaseModel
{
    public function getSource()
    {
        return "wx_user";
    }
    
    public function initialize()
    {
        parent::initialize();
        $this->hasManyToMany("id", "\Model\WechatUser", "uid", "wechat_id", "\Model\Wechat", "id",array("alias"=>"wechat"));
    }
}