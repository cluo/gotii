<?php
namespace Backend\Controller;
/**
 * 后台首页控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class IndexController extends BackendController
{
    public function indexAction()
    {
        $list = array();
        
        //非超级管理员用户需要检查公众号授权
        if (!$this->auth->check('superadmin',$this->user['id'])) {
            $user = \Model\User::findFirst(array("id=?1",'bind'=>array(1=>$this->user['id'])));
            if($user){
                $list = $user->getWechat();
            }
        } else {
            $list = \Model\Wechat::find();
        }
        
        $this->view->setVar('list',$list);
        $this->view->setVar('title','请选择公众号-');
    }
    
    public function loginWechatAction()
    {
        $id = $this->request->get('id','int');
        //检测公众号是否存在
        if (!$id || !$wechat = \Model\Wechat::findFirst(array("id=?1",'bind'=>array(1=>$id)))) {
            $msg = $this->message->error("公众号不存");
            return $this->response->setContent($msg);
        }
        //检测权限
        if (!$this->auth->check('superadmin', $this->user['id'])) {
            $user = \Model\User::findFirst(array("id=?1", 'bind' => array(1 => $this->user['id'])));
            if (!$user || !$user->getWechat()->count()) {
                $msg = $this->message->error("你没有权限访问");
                return $this->response->setContent($msg);
            }
        }
        //写入session后跳转到公众号管理页面
        $this->session->set('wechat',$wechat->toArray());
        $this->response->redirect($this->url->get('WxBasic/index'));
    }
}