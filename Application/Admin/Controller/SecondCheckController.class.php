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

class SecondCheckController extends MyController
{
    public function showSecondCheck(){
        $model=new Model;
        $data=$model->query("SELECT a.*,b.itemname,b.content,c.listname,e.teacher,f.sourse  from sx_tool a 
LEFT JOIN sx_sourse_item b on a.si_id=b.id 
LEFT JOIN sx_tool_list c on a.list_id=c.id 
LEFT JOIN sx_sourse_class_teacher d on b.sct_id=d.id 
LEFT JOIN sx_teacher e on e.id=d.teacher_id 
LEFT JOIN sx_sourse f on f.id=d.sourse_id where a.status=2 or a.status=3 or a.status=33");
        for($i=0;$i<count($data);$i++){
            $data[$i]['suoshu']='sx_tool';
        }
        $data2=$model->query("SELECT a.*,b.itemname,b.content,c.listname,e.teacher,f.sourse  from sx_consumable a 
LEFT JOIN sx_sourse_item b on a.si_id=b.id 
LEFT JOIN sx_consumable_list c on a.list_id=c.id 
LEFT JOIN sx_sourse_class_teacher d on b.sct_id=d.id 
LEFT JOIN sx_teacher e on e.id=d.teacher_id 
LEFT JOIN sx_sourse f on f.id=d.sourse_id where a.status=2 or a.status=3 or a.status=33");
        foreach($data2 as &$v){
            $v['suoshu']='sx_consumable';
        }
        unset($v);
        $data=array_merge($data,$data2);
//        $this->ajaxReturn($data);return;
        $this->assign(data,$data);
        $this->display();
    }
    public function pass1(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","3");
        echo $data;
    }
    public function cancelpass1(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","2");
        echo $data;
    }
    public function back1(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","33");
        echo $data;
    }
    public function cancelback1(){
        $id=I('get.id');
        $suoshu=I('get.suoshu');
        $model=M('');
        $data=$model->table("$suoshu")->where("id=$id")->setField("status","2");
        echo $data;
    }
//    //单击可以编辑的单元格
//    public function edit_table()
//    {
//        //接收参数
//        $id = $_GET['id'];
////        $field = $_GET['field'];
//        $values = $_GET['values'];//
//        $teacherModel = D('teacher');
//        if (!empty($values)) {
//            $data=$teacherModel->where("id=$id")->setField('teacher', $values);
//            echo $data;
//            exit;
//        } else {
//            echo '0';
//        }
//    }
//
//    //单击删除行
//    public function del_table()
//    {
//        $id = $_GET['id'];
//        $teacherModel = D('teacher');
//        echo $teacherModel->where("id=$id")->delete();
//    }
//
//    public function create_table()
//    {
//        $data['teacher'] = $_POST['field'];
//        $teacherModel = D('teacher');
//        if (empty($data['teacher'])) {
//            echo '0';
//            exit;
//        }
//        echo $teacherModel->add($data);
//    }
}
