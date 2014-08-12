<?php
namespace Controller;
/**
 * 默认控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        echo "!";
    }
    
    public function helloAction()
    {
        echo 'hello';
        exit;
    }
}