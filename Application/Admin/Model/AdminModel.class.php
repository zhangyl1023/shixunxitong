<?php

namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    public $_login_validate=array(
        array(),
        array(),
        array(),
        array(),
    );
    protected function check_verify($code,$id=''){
        $verify =new \Think\Verify();
        return $verify->check($code,$id);
    }
    //管理员登录
    public function login(){
        $admin_name=I('post.admin_name');
        $admin_password=I('post.admin_password');
        $info=$this->field("id,admin_password,salt")->where("admin_name='$admin_name'")->find();
        if($info){
            if($info['admin_password']==md5(md5($admin_password).$info['salt'])){
                $_SESSION['admin_id']=$info['id'];
                $_SESSION['admin_name']=$admin_name;
                return true;
            }
        }
        $this->error='用户名或密码错误';
        return false;
    }
}