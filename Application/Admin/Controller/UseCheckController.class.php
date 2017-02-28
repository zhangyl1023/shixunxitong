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

class UseCheckController extends MyController
{
    public function showUseCheck(){
        $model=new Model;
        $data=$model->query("SELECT a.*,b.itemname,b.content,c.listname,e.teacher,f.sourse  from sx_tool a 
LEFT JOIN sx_sourse_item b on a.si_id=b.id 
LEFT JOIN sx_tool_list c on a.list_id=c.id 
LEFT JOIN sx_sourse_class_teacher d on b.sct_id=d.id 
LEFT JOIN sx_teacher e on e.id=d.teacher_id 
LEFT JOIN sx_sourse f on f.id=d.sourse_id");
        for($i=0;$i<count($data);$i++){
            $data[$i]['suoshu']='sx_tool';
        }
        //缺where教师id*********************************************************************************************
        $data2=$model->query("SELECT a.*,b.itemname,b.content,c.listname,e.teacher,f.sourse  from sx_consumable a 
LEFT JOIN sx_sourse_item b on a.si_id=b.id 
LEFT JOIN sx_consumable_list c on a.list_id=c.id 
LEFT JOIN sx_sourse_class_teacher d on b.sct_id=d.id 
LEFT JOIN sx_teacher e on e.id=d.teacher_id 
LEFT JOIN sx_sourse f on f.id=d.sourse_id");
        foreach($data2 as &$v){
            $v['suoshu']='sx_consumable';
        }
        unset($v);
        $data=array_merge($data,$data2);
//        $this->ajaxReturn($data);return;
        $this->assign(data,$data);
        $this->display();
    }
    public function yilingqu(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","5");
        echo $data;
    }
    public function guihuan(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","6");
        echo $data;
    }
}
