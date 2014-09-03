<?php
namespace Lib\Events;
use Phalcon\Db\Profiler,
    Phalcon\Logger\Adapter\File as Logger;
/**
 * 数据库事件监听
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class MyDbListener
{
    protected $_di;
    protected $_logger;
    protected $_profiler;

    /**
     * Creates the profiler and starts the logging
     */
    public function __construct($di)
    {
        $this->setDi($di);
        $this->_logger = new Logger(RUNTIME_PATH."/logs/".date('Y-m-d').'.log');
        if($di){
            $this->_profiler = $di->get('profiler');
        }
    }

    /**
     * This is executed if the event triggered is 'beforeQuery'
     */
    public function beforeQuery($event, $connection)
    {
        if($this->_profiler){
            $this->_profiler->startProfile($connection->getSQLStatement());
        }
    }

    /**
     * This is executed if the event triggered is 'afterQuery'
     */
    public function afterQuery($event, $connection)
    {
        $this->_logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
        if($this->_profiler){
            $this->_profiler->stopProfile();
        }
    }

    public function getProfiler()
    {
        return $this->_profiler;
    }
    
    public function setDi($di)
    {
        $this->_di = $di;
    }
    
    public function getDi()
    {
        return $this->_di;
    }
}