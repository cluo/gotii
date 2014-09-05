<?php
namespace Backend\Controller;
/**
 * 公众号管理-自动回复管理
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class WxReplyController extends WechatController
{
    public function indexAction()
    {
        $this->dispatcher->forward(array(
            'action'=>'subscribe'
        ));
    }
    
    /**
     * 规则列表页
     */
    public function listAction()
    {
        $criteria = array(
            'conditions' => "wechat_id=:wechat_id: AND type=:type:",
            'bind' => array('wechat_id'=>$this->wechat['id'],'type'=>'0')
        );
        $list = \Model\ReplyRule::find($criteria);
        //读取所有keywords
        $klist = \Model\ReplyKeyword::find(array('wechat_id=:wechat_id:','bind'=>array('wechat_id'=>$this->wechat['id'])));
        $keywords = array();
        foreach ($klist as $k) {
            $keywords[$k->rule_id][] = $k;
        }
        $this->view->setVar('keywords',$keywords);
        $this->view->setVar('list', $list);
    }
    
    /**
     * 编辑规则
     */
    public function editAction()
    {
        $id = $this->request->get('id','int','0');
        
        if ($this->request->isPost() == true) {
            
        } else {
            $info = \Model\ReplyRule::findFirst($id);
            if (!$info || $info->wechat_id != $this->wechat['id']) {
                $msg = $this->message->error('规则不存在');
                return $this->response->setContent($msg);
            }
            $this->view->setVar('info', $info);
        }
    }
    
    /**
     * 添加规则
     */
    public function addAction()
    {
        $this->view->disable();
        $model = new \Model\ReplyRule();
        $model->wechat_id = $this->wechat['id'];
        if ($model->create($this->request->getPost('rule')) == false) {
            $res = array('status'=>0,'msg'=>$model->getLastMessage());
        } else {
            $res = array('status'=>1,'data'=>$model->toArray());
        }
        $this->response->setJsonContent($res)->send();
    }
    
    /**
     * 添加关键词
     */
    public function saveKeywordAction()
    {
        $this->view->disable();
        if ($this->request->isPost()) {
            $model = new \Model\ReplyKeyword();
            $model->wechat_id = $this->wechat['id'];
            $postdata = $this->request->getPost('keyword');
            if ($model->save($postdata) == false) {
                return $this->response->setJsonContent(array('status'=>0,'msg'=>$model->getLastMessage()));
            }
            return $this->response->setJsonContent(array('status'=>1,'data'=>$model->toArray()));
        } else {
            return $this->response->setJsonContent(array('status'=>0,'msg'=>'非法请求'));
        }
    }
    
    /**
     * 删除关键词
     */
    public function delKeywordAction()
    {
        $this->view->disable();
        if ($this->request->isPost()) {
            $ruleid = $this->request->get('ruleid','int');
            $id = $this->request->get('id','int');
            $keyword = new \Model\ReplyKeyword();
            if ($keyword->wxDelete($id,$ruleid,$this->wechat['id'])) {
                echo "ok";
            } else {
                echo "删除失败";
            }
        } else {
            echo "非法请求";
        }
    }
    
    
    /**
     * 机器人回复
     */
    public function robotAction()
    {
        
    }
    
    /**
     * 关注时回复
     */
    public function subscribeAction()
    {
        
    }
}

