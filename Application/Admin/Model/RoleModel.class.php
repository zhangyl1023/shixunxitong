<?php
namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{
    //首页展示
    protected $_validate = array(
        array('role_name', 'require', '角色名称不能为空')
    );
    protected function _after_insert($data,$options){
        $role_id=$data['id'];
        $priv_id=I('post.priv_id');
        foreach($priv_id as $v){
            M('role_privilege')->add(array('role_id'=>$role_id,'priv_id'=>$v));
        }
    }
    protected function _after_delete($data,$options){
        // p($data);
        // p($options);exit;
        $role_id = $options['where']['id'];
        M('role_privilege')->where("role_id=$role_id")->delete();
    }
}