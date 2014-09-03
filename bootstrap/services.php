<?php
/**
 * 注册全局服务
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */

$phalconDI = new \Phalcon\DI\FactoryDefault();

/**
 * 循环调度服务dispatcher
 */
//$phalconDI->set('dispatcher', function() use ($phalconDI){
//    //Create an event manager
//    $eventsManager = new \Phalcon\Events\Manager();
//    //Attach a listener for type "dispatch"
//    $eventsManager->attach("dispatch", function($event, $dispatcher) use ($phalconDI) {
//        //调度结束后
//        if ($event->getType() == 'afterDispatchLoop') {
//            //将profile写入到文件中
//            $profiles = $phalconDI->get('profiler')->getProfiles();
//            $logger = $phalconDI->get('logger');
//            $logger->begin();
//            $logger->info('======='.date('Y-m-d H:i:s').'=======');
//            foreach ($profiles as $profile) {
//                $logger->info($profile->getSQLStatement());
//            }
//            $logger->commit();
//        }
//    });
//
//    $dispatcher = new \Phalcon\Mvc\Dispatcher();
//
//    $dispatcher->setEventsManager($eventsManager);
//
//    return $dispatcher;
//
//}, true);

/**
 * 日志记录服务
 */
$phalconDI->set('logger',function(){
    return new \Phalcon\Logger\Adapter\File(RUNTIME_PATH."/logs/".date('Y-m-d').'.log');
},true);

/**
 * url组件
 */
$phalconDI->set('url',function() use ($config){
    $url = new \Lib\Extend\Url();
    //$url = new \Phalcon\Mvc\Url();
    $url->setBaseUri($config->baseuri);
    $url->setStaticBaseUri($config->staticbaseuri);
    return $url;
},true);

/**
 * sql记录工具
 */
$phalconDI->set("profiler",function(){
    return new \Phalcon\Db\Profiler();
},true);

/**
 * 数据库
 */
$phalconDI->set('db',function() use ($config,$phalconDI){
    //实例化db连接
    $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        "options" => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
        )
    ));
    //注册db事件管理器
    $eventsManager = new \Phalcon\Events\Manager();
    //用profile记录sql语句
    $profiler = $phalconDI->get('profiler');
    $eventsManager->attach("db",function($event,$connection) use ($profiler){
        if ($event->getType() == 'beforeQuery') {
            $profiler->startProfile($connection->getSQLStatement());
        } elseif ($event->getType() == 'afterQuery') {
            $profiler->stopProfile();
        } 
    });
    //$eventsManager->attach('db', new \Lib\Events\MyDbListener($phalconDI));
    $connection->setEventsManager($eventsManager);
    //返回db实例
    return $connection;
},true);

/**
 * 模型元数据缓存组件
 */
$phalconDI->set('modelsMetadata', function () {
    //默认使用内存缓存，即每次请求过程中只读取一次
    return new \Phalcon\Mvc\Model\Metadata\Memory();
});

/**
 * session会话管理组件
 */
$phalconDI->set('session', function () {
    //采用文件存储session
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
}, true);

/**
 * 默认视图组件
 */
$phalconDI->set('view',function(){
    //采用默认php引擎，最大化性能
    $view = new \Phalcon\Mvc\View();
    $view->setViewsDir(APP_PATH."/views/");
    $view->registerEngines(array(
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));
    return $view;
},true);

//注册路由
$phalconDI->set('router', function () use ($config) {
    //初始化路由
    $router = new \Phalcon\Mvc\Router();
    $router->setDefaultNamespace("Controller");
    $router->setDefaultController('Index');
    $router->setDefaultAction('index');
    $router->add('/',array(
        "controller"=>'Index',
        "action"=>'index'
    ));
    $router->notFound(array('controller'=>'httperr','action'=>'err404'));
    return $router;
}, true);

/**
 * 信息提示组件
 * @author 吾爱 <carlton.cheng@foxmail.com>
 */
$phalconDI->set('message',function(){
    return new \Wuai\Utils\Message\ViewMessage();
},true);