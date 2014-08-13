<?php
namespace Backend\Controller;
/**
 * 开放控制器，用于登录、注销等无需身份验证的功能
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class PublicController extends \Phalcon\Mvc\Controller
{
    public function loginAction()
    {
        if( ! $this->request->isPost()) {
            $this->view->setVar('title', '后台管理系统');
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = \Model\User::findFirst(array("username = ?1","bind"=>array(1=>$username)));
            if( ! $user || $user->password != md5($password)){
                $message = new \Wuai\Message\ViewMessage();
            }
            $this->view->disable();
        }
    }
}