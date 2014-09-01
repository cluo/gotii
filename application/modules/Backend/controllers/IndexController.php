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
        $list = \Model\Wechat::find();
        $this->view->setVar('list',$list);
        $this->view->setVar('title','请选择公众号-');
    }
    
    public function loginWechatAction()
    {
        $id = $this->request->get('id','int');
        //存在和权限判断
        if (!$id || !$wechat = \Model\Wechat::findFirst(array("id=?1",'bind'=>array(1=>$id)))) {
            $msg = $this->message->error("公众号不存在或没有权限管理");
            return $this->response->setContent($msg);
        }
        //写入session后跳转到公众号管理页面
        $this->session->set('wechat',$wechat->toArray());
        $this->response->redirect($this->url->get('WxBasic/index'));
    }
}