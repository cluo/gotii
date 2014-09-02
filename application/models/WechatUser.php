<?php
namespace Model;
/**
 * 公众号-用户关联表
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WechatUser extends BaseModel
{
    //表名
    public function getSource()
    {
        return "wx_wechat_user";
    }
    
    public function initialize()
    {
        parent::initialize();
//        $this->belongsTo("uid", "\Model\User", "id",array("alias"=>"user"));
//        $this->belongsTo("wechat_id", "\Model\Wechat", "id",array("alias"=>"wechat"));
    }
}