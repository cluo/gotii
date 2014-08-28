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
        $auth = $this->di->get('auth');
        $auth->check('/ma',1);
        exit;
    }
}