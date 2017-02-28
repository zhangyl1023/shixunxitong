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

class SourseItemController extends MyController
{
    public function showSourseItem()
    {
        $model=M('sourse_item');
        $data=$model->field('a.*,c.sourse')->table('sx_sourse_item a')->join('sx_sourse_class_teacher b on b.id=a.sct_id')->join('sx_sourse c on b.sourse_id=c.id')->select();
        for($i=0;$i<count($data);$i++){
            $si_id=$data[$i]['id'];
            $data2=$model->field('a.*,b.listname,b.unit')->table('sx_consumable a')->join('sx_consumable_list b on a.list_id=b.id')->where("si_id=$si_id")->select();
            $data3=$model->field('a.*,b.listname,b.unit')->table('sx_tool a')->join('sx_tool_list b on a.list_id=b.id')->where("si_id=$si_id")->select();
            $data[$i]['consumable']=$data2;
            $data[$i]['tool']=$data3;
        }
//        echo '<pre>';print_r($data);return;
        $this->assign(data,$data);
        $this->display();
    }
    public function addSourseItem(){
        if(IS_POST){
            $data['sct_id']=I('post.sct_id');
            $data['itemname']=I('post.itemname');
            $data['content']=I('post.content');
            $data['consumable_id']=implode(',',I('post.consumable_list'));
            $data['tool_id']=implode(',',I('post.tool_list'));
            $data['add_time']=time();
            $model=M('sourse_item');
            $tempscid=$model->add($data);
            for($i=0;$i<count(I('post.consumable_list'));$i++){
                if(empty(I('post.numb')[$i])){
                    continue;
                }
                $data2[$i]['si_id']=$tempscid;
                $data2[$i]['add_time']=$data['add_time'];
                $data2[$i]['list_id']=I('post.consumable_list')[$i];
                $data2[$i]['numb']=I('post.numb')[$i];
            }
            for($j=0;$j<count(I('post.tool_list'));$j++){
                if(empty(I('post.tool_numb')[$j])){
                    continue;
                }
                $data3[$j]['si_id']=$tempscid;
                $data3[$j]['add_time']=$data['add_time'];
                $data3[$j]['list_id']=I('post.tool_list')[$j];
                $data3[$j]['numb']=I('post.tool_numb')[$j];
            }
            $model2=M('consumable');
            $model2->addAll($data2);
            $model3=M('tool');
            $model3->addAll($data3);
            redirect(U('showSourseItem'));
        }else{
            $model=M('sourse_class_teacher');
            //根据教师id查询相对应课程
            $data=$model->query("SELECT a.*,b.sourse,c.class,d.profession from sx_sourse_class_teacher a LEFT JOIN sx_sourse b on a.sourse_id=b.id LEFT JOIN sx_class c on a.class_id=c.id LEFT JOIN sx_profession d on d.id=c.profession_id where a.teacher_id=4;");
            $this->assign(data,$data);
            $dataa=$model->query("SELECT a.*,b.listname from sx_sct_consumablelist a LEFT JOIN sx_consumable_list b on a.list_id=b.id where a.sct_id=77 and a.suoshu_id=1;");
            $dataaa=$model->query("SELECT a.*,b.listname from sx_sct_consumablelist a LEFT JOIN sx_tool_list b on a.list_id=b.id where a.sct_id=77 and a.suoshu_id=2;");
            $dataa=array_merge($dataa,$dataaa);
            $this->assign(dataa,$dataa);
            $this->display();
        }
    }
    public function searchsourse(){
        $sct_id=I('get.sct_id');
        $model=M('sourse_class_teacher');
        $data=$model->query("SELECT a.*,b.listname,b.id idd from sx_sct_consumablelist a LEFT JOIN sx_consumable_list b on a.list_id=b.id where a.sct_id=$sct_id and a.suoshu_id=1;");
        $table=array('table'=>'sx_consumable_list');
        for ($i=0;$i<count($data);$i++){
            $data[$i]=array_merge($data[$i],$table);
        }
        $dataa=$model->query("SELECT a.*,b.listname,b.id idd from sx_sct_consumablelist a LEFT JOIN sx_tool_list b on a.list_id=b.id where a.sct_id=$sct_id and a.suoshu_id=2;");
        $tablee=array('table'=>'sx_tool_list');
        for ($i=0;$i<count($dataa);$i++){
            $dataa[$i]=array_merge($dataa[$i],$tablee);
        }
        $data=array_merge($data,$dataa);
        $this->ajaxReturn($data);
    }
    public function displayunit(){
        $id=I('get.id');
        $model=M('consumable_list');
        $data=$model->where("id=$id")->select();
        $this->ajaxReturn($data);
    }
    public function displayunittool(){
        $id=I('get.id');
        $model=M('tool_list');
        $data=$model->where("id=$id")->select();
        $this->ajaxReturn($data);
    }

    //单击删除行
    public function del_table()
    {
        $id = $_GET['id'];
        $Model = D('sourse');
        echo $Model->where("id=$id")->delete();

    }

}