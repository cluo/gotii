<?php
namespace Backend\Controller;
/**
 * 公众号管理控制器
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
class UploadController extends BackendController
{
    public function imageAction()
    {
        $this->view->disable();
        $this->response->setContentType('application/json');
        $res = array();        
        if ($this->request->hasFiles()) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $res = array('error'=>0,'url'=>'upload/1.jpg');
            }
        } else {
            $res = array('error'=>1,'message'=>'没检测到图片');
        }
        return $this->response->setContent(json_encode($res));
    }
}