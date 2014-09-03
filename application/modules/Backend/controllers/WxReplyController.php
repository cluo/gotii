<?php
namespace Backend\Controller;
/**
 * 公众号管理-自动回复管理
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WxReplyController extends WechatController
{
    public function indexAction()
    {
        $this->dispatcher->forward(array(
            'action'=>'subscribe'
        ));
    }
    
    /**
     * 关注时回复
     */
    public function subscribeAction()
    {
        
    }
    
    /**
     * 关键词回复
     */
    public function keywordAction()
    {
        $criteria = array(
            'conditions' => "wechat_id=:wechat_id: AND type=:type:",
            'bind' => array('wechat_id'=>$this->wechat['id'],'type'=>'0')
        );
        $list = \Model\ReplyRule::find($criteria);
        $this->view->setVar('list', $list);
    }
    
    /**
     * 机器人回复
     */
    public function robotAction()
    {
        
    }
    
    /**
     * 添加规则
     */
    public function addRuleAction()
    {
        $this->view->disable();
        $model = new \Model\ReplyRule();
        $model->wechat_id = $this->wechat['id'];
        if ($model->create($this->request->getPost('newrule')) == false) {
            echo "添加失败";
        }
        echo "ok";
    }
}

