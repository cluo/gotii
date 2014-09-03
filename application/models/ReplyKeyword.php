<?php
namespace Model;
/**
 * 自动回复关键词表
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class ReplyKeyword extends BaseModel
{
    public $id;
    public $wechat_id;
    public $rule_id = "0";
    public $match_method = "0";
    public $keyword = "";
    
    //表名
    public function getSource()
    {
        return "wx_reply_keyword";
    }
}