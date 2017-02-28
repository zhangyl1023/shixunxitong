<?php
namespace Admin\Controller;

use Think\Controller;

class PrivilegeController extends MyController
{
    public function showPrivilege()
    {
        $model = D('privilege');
        $data = $model->getTree();
        $this->assign('data', $data);
        $this->display();
    }

    //首页展示
    public function addPrivilege()
    {
        $privmodel = D("Privilege");
        if (IS_POST) {
            $data=I('post.');
            if ($privmodel->add($data)) {
                redirect(U('showPrivilege'));exit;
            } else {
                $this->error('添加失败');
            }

        }
        $data = $privmodel->getTree();
        $this->assign('data', $data);
        $this->display();
    }
}