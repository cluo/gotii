<?php
namespace Backend\Controller;
use \Model\Wechat as Wechat;
/**
 * 公众号管理控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WechatController extends BackendController
{
    public function indexAction()
    {
        $list = Wechat::find();
        $this->view->setVar('list',$list);
        $this->view->setVar('title','公众号管理-');
    }
    
    public function addAction()
    {
        $this->view->setVar('title','添加公众号-');
    }
    
    public function editAction()
    {
        $id = $this->request->getQuery('id','int','0');
        $id && $info = Wechat::findFirst(array('id=?1','bind'=>array(1=>$id)));
        if (empty($info)) {
            echo $this->message->error('账号不存在');
            return $this->view->disable();
        }
        xdebug_var_dump($info);
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