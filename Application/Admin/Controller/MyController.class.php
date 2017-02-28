<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class MyController extends Controller
{
    public function _initialize()
    {
        $admin_id = $_SESSION['admin_id'] + 0;
        if ($admin_id > 0) {
            //左侧菜单遍历菜单
            $menumodel = new Model();
            $menu = $menumodel->query("SELECT d.* from sx_admin a LEFT JOIN sx_admin_role b on a.id=b.admin_id LEFT JOIN sx_role_privilege c on b.role_id=c.role_id LEFT JOIN sx_privilege d on c.priv_id=d.id where d.parent_id=0 and a.id=$admin_id order by d.id");
            foreach ($menu as &$v) {
                $parent = $v['id'];
                $menu2 = $menumodel->query("SELECT d.* from sx_admin a LEFT JOIN sx_admin_role b on a.id=b.admin_id LEFT JOIN sx_role_privilege c on b.role_id=c.role_id LEFT JOIN sx_privilege d on c.priv_id=d.id where d.parent_id=$parent and a.id=$admin_id");
                $v['child'] = $menu2;
            }
            $this->assign('menu', $menu);
            //校验url是否有权访问
//            $module_name = MODULE_NAME;
//            $controller_name = CONTROLLER_NAME;
//            $action_name = ACTION_NAME;
//            $url = M()->query("SELECT d.* from sx_admin a
//LEFT JOIN sx_admin_role b on a.id=b.admin_id
//LEFT JOIN sx_role_privilege c on b.role_id=c.role_id
//LEFT JOIN sx_privilege d on c.priv_id=d.id where d.module_name='$module_name' and d.controller_name='$controller_name' and d.action_name='$action_name' and a.id=$admin_id");
//            if (!$url) {
//                $this->error('无权限访问');
//            }
            return true;
        } else {
            $this->error('请您先登录', U('Login/login'), 1);
        }exit;
    }
}

?>