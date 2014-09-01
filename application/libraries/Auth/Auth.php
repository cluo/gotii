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
        'type'=>0,
        'table_rule' => 'wx_auth_rule',
        'table_group' => 'wx_auth_group',
        'table_group_rule' => 'wx_auth_group_rule',
        'table_group_user' => 'wx_auth_group_user'
    );
    
    /**
     * 自定义配置参数
     * @param array $options
     */
    public function setOptions(Array $options)
    {
        $this->options = array_merge($this->options,$options);
    }
    
    /**
     * 检测权限
     * @param mixed $name 规则名 字符串or数组
     * 如果数组中有'or'=>true，那么表示该数组中所有规则只要有一个通过就行，否则需要全部通过,数组可嵌套
     * 如：array('rule1',array('rule2','rule3','or'=>1))对应的权限逻辑为：rule1 and (rule2 or rule3)
     * @param int $uid 用户uid
     * @return boolean
     */
    public function check($name,$uid)
    {
        static $authList;
        if(!$authList){
            $authList = $this->getRids($uid);
        }
        
        $allow = false;
        
        //用户没有任何权限，直接返回false
        if (empty($authList)) {
            return false;
        }
        
        //name是字符串
        if (is_string($name)) {
            return in_array($name,$authList);
        }
        
        //name是数组
        if (is_array($name)) {
            $or = isset($name['or'])?true:false;
            unset($name['or']);
            foreach($name as $item){
                $result = $this->check($item,$uid);
                if ($result) {
                    $allow = true;
                    if ($or == true) {
                        break;
                    }
                } else {
                    $allow = false;
                }
            }
            return $allow;
        }
        
        return false;
    }
    
    /**
     * 检测是否在某个用户组里面
     * @param int $gid
     * @param int $uid
     * @return boolean
     */
    public function checkGroup($gid,$uid)
    {
        $gids = $this->getGids($uid);
        return $gids && in_array($uid,$gids);
    }
    
    /**
     * 根据一组规则来验证是否允许访问
     * @param string $key 规则表的key
     * @param array $rule array('key1'=>rule1,'key2'=>'rule2',...'*'=>'rule*')
     * @param int $uid  用户id
     * @return boolean
     * 如果$rule中定义了$key的规则，那么根据这个规则来验证权限
     * 如果没有定义$key，那么看是否定义了'*'的规则，有的话检测*对应的权限
     * 如果没有定义$key和*，那么默认允许访问
     */
    public function checkByRule($key,$rule,$uid)
    {
        if (empty($rule)) return true;//没有定义规则，则默认所有人可以访问
        
        //先判断有指定key为$key的规则
        if (isset($rule[$key])) {
            return $this->check($rule[$key],$uid);
        }
        //检测是否定义了key为*的规则
        if (isset($rule['*'])) {
            return $this->check($rule['*'],$uid);
        }
        
        //权限校验失败，返回false
        return true;
    }
    /**
     * 读取用户拥有的权限
     * @param int $uid 用户uid
     * @return Array
     */
    public function getRids($uid)
    {
        static $rules = array();//初始化权限列表，静态缓存
        
        if(!empty($rules)) return $rules;//如果已经取过一次，则直接返回
        
        //读取用户组信息
        $gids = $this->getGids($uid);
        if($gids)
        {
            //读取权限列表
            $gids_sql = implode("','",$gids);
            $query1 = $this->db->prepare("select r.name from `{$this->options['table_rule']}` as r left join `{$this->options['table_group_rule']}` gr on r.id=gr.rid where gr.gid in ('".$gids_sql."')");
            if ($query1->execute()) {
                $rules = $query1->fetchAll(\PDO::FETCH_COLUMN,0);
            }
        }
        
        return $rules;
    }
    
    /**
     * 获取用户组id列表
     * @param type $uid
     * @return type
     */
    public function getGids($uid)
    {
        $gids = array();
        $groups = $this->getGroups($uid);
        if ($groups) {
            foreach ($groups as $group) {
                $gids[] = $group['id'];
            }
        }
        return $gids;
    }
    
    /**
     * 读取用户组列表
     * @param type $uid
     */
    public function getGroups($uid)
    {
        static $groups = array();
        
        if(!empty($groups)) return $groups;
        
        $query = $this->db->prepare("select g.* from `{$this->options['table_group']}` as g left join `{$this->options['table_group_user']}` as gu on g.id=gu.gid where gu.uid=:uid and g.status='1'");
        $query->bindValue(':uid',$uid);
        if ($query->execute()) {
            $groups = $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $groups;
    }
    
    public function getDI()
    {
        return $this->di;
    }
    
    public function setDI($di)
    {
        $this->di = $di;
    }
    
    /**
     * 智能读取di里的服务
     * @param String $name 变量名
     * @return mixed
     */
    public function __get($name)
    {
        return $this->di->get($name);
    }
}
