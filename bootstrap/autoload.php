<?php
/**
 * 自动加载策略
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

include ROOT_PATH."/vendor/autoload.php";//composer的自动加载器

/*框架的自动加载规则*/
$phalconLoader = new \Phalcon\Loader();

$phalconLoader->registerNamespaces(array(
    "Controller" => APP_PATH."/controllers",
    "Model"=>APP_PATH."/models",
    "Lib"=>APP_PATH."/libraries"
));//通过命名空间路径映射实现自动加载

$phalconLoader->register();
