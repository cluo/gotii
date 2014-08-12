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
            xdebug_var_dump($_POST);
            $this->view->disable();
        }
    }
}