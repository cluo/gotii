<?php
namespace Lib\Extend;
/**
 * url生成器扩展
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class Url extends \Phalcon\Mvc\Url
{
    public function get($path=null, $args=null, $local=null)
    {
        //如果是外链，直接返回
        if(strpos($path,"http://")===0 || strpos($path,"/")===0){
            return parent::get(trim($path,'/'),$args,$local);
        }
        $url = array();
        //从容器中获取dispatcher服务
        $dispatcher = $this->getDI()->get("dispatcher");
        //获取当前模块、控制器和动作名
        $module = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        //分析path路径
        $path = explode("/",trim($path,'/'));
        $url["action"] = !empty($path)?array_pop($path):$action;
        $url["controller"] = !empty($path)?array_pop($path):$controller;
        $url["module"] = !empty($path)?array_pop($path):$module;
        return parent::get($url['module']."/".$url['controller']."/".$url['action'],$args,$local);
    }
}
