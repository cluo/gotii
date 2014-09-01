<?php
namespace Backend\Controller;
use \Model\Wechat as Wechat;
/**
 * 公众号账号管理控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WechatAccountController extends BackendController
{
    public function indexAction()
    {
        $list = Wechat::find();
        $this->view->setVar('list',$list);
        $this->view->setVar('title','公众号管理-');
    }
    
    public function addAction()
    {
        $token = uniqid();
        $info = (object)array(
            'token' => $token
        );
        $this->view->setVar('info',$info);
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
        $this->view->setVar('info',$info);
    }
    
    public function updateAction()
    {
        $this->view->disable();
        
        if (!$this->request->isPost())
        {
            echo $this->message->error("非法请求");
            return false;
        }
        
        $data = $this->request->getPost('wechat');
        
        $wechat = new \Model\Wechat();
        
        if ($wechat->save($data) == false) {
            echo "出错了:<br/>";
            foreach ($wechat->getMessages() as $message) {
                echo $message, "<br/>";
            }
        } else {
            $msg = empty($data['id'])?'添加成功':'保存成功';
            echo $this->message->success($msg,$this->url->get('Backend/wechat'));
            //echo $this->profiler->getLastProfile()->getSQLStatement();
        }
    }
}