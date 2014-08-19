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
        if ($this->session->get('user')) {
            return $this->response->setContent($this->message->error('你已经登录，请先退出'));
        }
        if (!$this->request->isPost()) {
            $this->view->setVar('title', '后台管理系统');
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            if (!$this->login($username, $password)) {
                echo $this->message->error("用户名密码错误");
            } else {
                $this->response->redirect("Backend/index/index");
            }
            $this->view->disable();
        }
    }

    public function logoutAction()
    {
        $this->session->remove('user');
        echo $this->message->success('注销成功');
    }
    
    private function login($username, $password)
    {
        $user = \Model\User::findFirst(array("username = ?1", "bind" => array(1 => $username)));
        if (! $user || ($user->password != md5($password))) {
            return false;
        }
        //写session
        $this->session->set('user', $user->toArray());
        //更新登录记录
        $user->lasttime = time();
        $user->lastip = $this->request->getClientAddress();
        $user->save();
        return true;
    }

}
