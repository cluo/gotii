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
        
    }
    
    /**
     * 机器人回复
     */
    public function robotAction()
    {
        
    }
}

