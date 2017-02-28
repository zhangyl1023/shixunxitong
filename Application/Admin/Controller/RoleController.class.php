<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends MyController {
    //首页展示
    public function addRole(){
        if(IS_POST){
            $model=M('role');
            $data['role_name']=I('role_name');
            $data2=$model->add($data);
            $role_id=$data2;
            $priv_id=I('post.priv_id');
            foreach($priv_id as $v){
                M('role_privilege')->add(array('role_id'=>$role_id,'priv_id'=>$v));
            }
            if(count($priv_id)>0){
                $this->success('添加成功',U('showrole'),3);exit;
            }else{
                $this->error('添加失败');
            }
        }
        $model=D("Privilege");
        $data=$model->getTree();
        $this->assign('data',$data);
        $this->display();
    }
    public function showRole(){
        $model=M('role');
        $data=$model->select();
        foreach($data as &$v){
            $data2=$v['id'];
            $v['privilege']=D('privilege')->getTree();
//            $v['privilege']=M('role_privilege')->table("sx_role_privilege a")->join('sx_privilege b on a.priv_id=b.id')->where("role_id=$data2")->select();
        }
//        echo '<pre>';print_r($data);die;
        $this->assign('data',$data);
        $this->display();
    }
}