<?php
/**
 * 自动加载策略
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

$phalconLoader = new \Phalcon\Loader();
$phalconLoader->registerNamespaces(array(
    "Controller" => APP_PATH."/controllers",
    "Model"=>APP_PATH."/models"
));
$phalconLoader->register();