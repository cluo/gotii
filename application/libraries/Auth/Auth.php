<?php
namespace Lib\Auth;
/**
 * Auth权限认证
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class Auth implements \Phalcon\DI\InjectionAwareInterface
{
    private $di;
    private $options = array(
        'type'=>0
    );
    
    /**
     * 自定义配置参数
     * @param array $options
     */
    public function setOptions(Array $options)
    {
        $this->options = array_merge($this->options,$options);
    }
    
    public function check($name,$uid)
    {
        $authList = $this->getAuthList($uid);
    }
    
    public function getAuthList($uid)
    {
        $smt = $this->db->prepare("select gid from `wx_auth_group_user` where uid=:uid");
        $smt->bindValue(':uid',$uid);
        if ($smt->execute()) {
            $result = $smt->fetchAll(\PDO::FETCH_COLUMN,0);
        }
        xdebug_var_dump($result);
    }
    
    public function getDI()
    {
        return $this->di;
    }
    
    public function setDI($di)
    {
        $this->di = $di;
    }
    
    public function __get($name){
        return $this->di->get($name);
    }
}