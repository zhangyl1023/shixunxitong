<?php
/**
 * Created by PhpStorm.
 * User: yingliang
 * Date: 2017/1/19
 * Time: 16:57
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class AdminController extends MyController
{
    public function showAdmin()
    {
        $model = M('admin');
        $data = $model->field('a.admin_name,c.role_name')->table('sx_admin a')->join('sx_admin_role b on a.id=b.admin_id')->join('sx_role c on c.id=b.role_id')->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function addAdmin()
    {
        if (IS_POST) {
            $data['admin_name'] = I("post.admin_name");
            $admin_password = I("post.admin_password");
            $rpassword = I("post.rpassword");
            $data2['role_id'] = I('post.role_id');
            if ($data2['role_id'] == '') {
                $this->error('必须选择一个角色');
            }
            if ($admin_password != "$rpassword") {
                $this->error('两次输入的密码不一致');
            }
            $data['salt']=substr(uniqid(),-6);
            $data['admin_password']=md5(md5($admin_password).$data['salt']);
            $data2['admin_id']=M('admin')->add($data);
            $temp=M('admin_role')->add($data2);
            if($temp>0){
                redirect(U('showAdmin'));
            }
        }
        $model = M('role');
        $data = $model->select();
        $this->assign('data', $data);;
        $this->display();
    }
    //单击删除行
//    public function del_table()
//    {
//        $id = $_GET['id'];
//        $Model = D('class');
//        echo $Model->where("id=$id")->delete();
//
//    }

}