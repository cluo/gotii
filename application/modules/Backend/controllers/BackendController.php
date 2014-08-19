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
    public function initialize()
    {
        if (!($user = $this->session->get('user'))) {
            $this->response->redirect('Backend/public/login');
        }
        $this->user = $user;
        $this->view->setVar('user', $this->user);
    }
}