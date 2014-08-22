<?php
namespace Backend\Controller;
/**
 * 公众号管理控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WechatController extends BackendController
{
    public function indexAction()
    {
        
    }
    
    public function addAction()
    {
        
    }
    
    public function updateAction()
    {
        $this->view->disable();
        if (!$this->request->isPost())
        {
            echo $this->message->error("非法请求");
            return false;
        }
        $wechat = new \Model\Wechat();
        $data = $this->request->getPost('wechat');
        $wechat->token = uniqid();
        $wechat->name = $data['name'];
        $wechat->type = $data['type'];
        $wechat->verified = $data['verified'];
        $wechat->avatar = $data['avatar'];
        if ($wechat->create() == false) {
            echo "Umh, We can't store robots right now: \n";
            foreach ($wechat->getMessages() as $message) {
                echo $message, "\n";
            }
        } else {
            echo "Great, a new robot was created successfully!";
        }
    }
}