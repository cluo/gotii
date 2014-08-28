<?php
namespace Controller;
/**
 * http错误
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class HttperrController extends \Phalcon\Mvc\Controller
{
    public function err404Action()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status:404 Not Found');
    }
}