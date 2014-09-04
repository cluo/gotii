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
    
    public function beforeSave()
    {
        $rule = \Model\ReplyRule::findFirst(array("id=?1 AND wechat_id=?2",'bind'=>array(1=>$this->rule_id,2=>$this->wechat_id)));
        if (!$rule) {
            return false;
        }
    }
    
    /**
     * 删除指定关键词
     * @param int $id 主键id
     * @param int $ruleid 规则表
     * @param int $wechat_id 所属公众号id
     * @return boolean
     */
    public function wxDelete($id,$ruleid,$wechat_id)
    {
        $criteria = array(
            'conditions' => 'id=?1 AND rule_id=?2 AND wechat_id=?3',
            'bind' => array(1=>$id,2=>$ruleid,3=>$wechat_id)
        );
        if ($re = $this->findFirst($criteria)) {
            return $re->delete();
        }
        return false;
    }
}