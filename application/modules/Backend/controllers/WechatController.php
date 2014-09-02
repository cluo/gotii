<?php
namespace Backend\Controller;
/**
 * 公众号功能父控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
abstract class WechatController extends BackendController
{
    public $wechat;
    
    //前置
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();
        $this->wechat = $this->session->get('wechat');
        
        if (!$this->wechat) {
            $this->view->disable();
            echo $this->message->error('请从首页进入管理');
            return false;
        }
        $this->view->setVar('wechat', $this->wechat);
        $this->view->setVar('menus',$this->getMenus());
    }
    
    public function getMenus()
    {
        return array(
            'g1' => array(
                'text' => '统计信息',
                'children' => array(
                    'c1' => array('text' => '微信概况', 'url' => $this->url->get('WxBasic/dashboard'))
                )
            ),
            'g2' => array(
                'text' => '自动回复',
                'children' => array(
                    'c1' => array('text' => '关注时回复', 'url' => $this->url->get('WxReply/subscribe')),
                    'c2' => array('text' => '关键词回复', 'url' => $this->url->get('WxReply/keyword')),
                    'c3' => array('text' => '机器人回复', 'url' => $this->url->get('WxReply/robot'))
                )
            ),
            'g3' => array(
                'text' => '素材库',
                'children' => array(
                    'c1' => array('text' => '图文素材', 'url' => $this->url->get('WxBasic/dashboard'))
                )
            ),
            'g4' => array(
                'text' => '我的粉丝',
                'children' => array(
                    'c1' => array('text' => '粉丝列表', 'url' => $this->url->get('WxBasic/dashboard'))
                )
            )
        );
        
    }
}

