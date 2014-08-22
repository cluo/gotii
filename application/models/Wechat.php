<?php
namespace Model;
/**
 * 公众号信息模型
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class Wechat extends \Phalcon\Mvc\Model
{
    public function getSource()
    {
        return "wx_wechat";
    }
}