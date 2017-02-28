<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    //首页展示
    public function login(){
        if(IS_POST){
            $adminmodel=D('Admin');
            if($adminmodel->login()){
                redirect(U('Index/index'));
            }
            $this->error($adminmodel->getError());
        }
        $this->display();
    }
    public function checkcode(){
        $config=array(
            'fontSize'=>20,
            'length'  =>4,
            'useNoice'=>true,
            'imageW'  =>120,
            'imageH'   =>40,
            'useCurve'  =>true
        );
        $Verify= new \Think\Verity($config);
        $Verify->codeset='23456789';
        $Verify->entry();
    }
}