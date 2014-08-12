<?php
/**
 * 模块注册
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

$router = $phalconDI->get('router');
$modules = array();

//遍历模块&注册路由&模块引导文件
foreach ($config->modules as $module) {
    //添加模块路由规则
    $router->add("/{$module}/?([A-Za-z0-9_-]*)/?([A-Za-z0-9_-]*)(/.*)*", array(
        'namespace'=>$module.'\Controller',
        'module' => $module,
        'controller' => 1,
        'action' => 2,
        'params' => 3,
    ));
    //模块
    $modules[$module] = array(
        'className'=>'Module',
        'path'=>APP_PATH.'/modules/'.$module.'/Module.php'
    );
}

//注册模块到应用
$application->registerModules($modules);