<?php
namespace Model;
/**
 * \Model\BaseModel.php
 * 模型公共父类，抽象，只允许继承
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
abstract class BaseModel extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
//        self::setup(array(
//            'notNullValidations'=>false
//        ));
    }
    
    public function getAttributes()
    {
        return $this->getModelsMetaData()->getAttributes($this);
    }
    
    public function getPk()
    {
        return $this->getModelsMetaData()->getPrimaryKeyAttributes($this);
    }
}