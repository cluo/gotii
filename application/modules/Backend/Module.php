<?php
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface{
    /**
     * 注册自动加载规则
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Backend\Controller'=>APP_PATH."/modules/backend/controllers",
            'Backend\Model'=>APP_PATH."/modules/backend/models",
        ), true);
            
        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices($di)
    {
        //volt模板引擎服务
        $di->set('voltService', function($view, $di) {
            $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
            $volt->setOptions(array(
                "compiledPath" => APP_PATH."/runtime/volt/",
                "compiledExtension" => ".compiled"
            ));
            return $volt;
        });
        //注册视图服务
        $di->set('view', function(){
            $view = new \Phalcon\Mvc\View(); //初始化视图
            $view->setViewsDir(APP_PATH."/modules/Backend/views/");
            $view->registerEngines(array(
                //'.phtml' => 'Phalcon\Mvc\View\Engine\Php',
                '.phtml' => 'voltService'
            ));
            return $view;
        }, true);
    }
}