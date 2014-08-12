<?php
namespace Backend\Controller;
/**
 * 后台公共控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
abstract class BackendController extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->response->redirect('Backend/public/login');
    }
}