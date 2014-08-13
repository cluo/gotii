<?php
namespace Model;
/**
 * [文件描述]
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class User extends \Phalcon\Mvc\Model
{
    public function getSource()
    {
        return "gotii_user";
    }
}