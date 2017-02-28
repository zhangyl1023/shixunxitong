<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends MyController {
    //首页展示
    public function index(){
        $this->display();
    }
}