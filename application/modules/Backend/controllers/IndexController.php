<?php
namespace Backend\Controller;
/**
 * [文件描述]
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class IndexController extends BackendController
{
    public function indexAction()
    {
        print_r($this->user);
    }
}