<?php
namespace Backend\Controller;
/**
 * 公众号功能父控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
abstract class WechatController extends BackendController
{
    public $wechat;
    
    //前置
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
        $this->wechat = $this->session->get('wechat');
        
        if (!$this->wechat) {
            $this->view->disable();
            echo $this->message->error('请从首页进入管理');
            return false;
        }
        $this->view->setVar('wechat', $this->wechat);
    }
}

