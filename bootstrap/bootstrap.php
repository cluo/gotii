<?php
/**
 * 项目引导脚本
 * 加载配置、创建di、自动加载策略、注册服务、注册模块
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

/*初始化几个对象*/
$composerLoader = include ROOT_PATH."/vendor/autoload.php";//composer的自动加载器
$config = new \Phalcon\Config(include __DIR__."/configs/main.conf.php");//项目配置
$application = new \Phalcon\Mvc\Application();

/*基本流程，按顺序执行*/
require __DIR__."/autoload.php";//项目自动加载策略配置
require __DIR__."/services.php";//注册服务
require __DIR__."/modules.php";//注册模块

$application->setDI($phalconDI);
/*处理请求，并输出响应内容*/
echo $application->handle()->getContent();