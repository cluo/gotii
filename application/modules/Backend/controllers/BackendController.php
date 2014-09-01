<?php
namespace Backend\Controller;
/**
 * 后台公共控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
abstract class BackendController extends \Phalcon\Mvc\Controller
{
    public $user;
    public function beforeExecuteRoute()
    {
        if (!($user = $this->session->get('user'))) {
            $this->response->redirect('Backend/public/login');
        }
        $this->user = $user;
        $this->view->setVar('user', $this->user);
        //检测权限
        if (!$this->auth->checkByRule($this->dispatcher->getActionName(),$this->getAuthRule(),$this->user['id'])) {
            $this->view->disable();
            echo $this->message->error('抱歉你没有权限访问该页面');
            return false;
        }
    }
    
    public function getAuthRule()
    {
        return array();
    }
}