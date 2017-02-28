<?php
/**
 * Created by PhpStorm.
 * User: yingliang
 * Date: 2017/1/17
 * Time: 16:15
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class ConsumableController extends MyController
{
    //展示耗材清单
    public function showConsumable(){
        $model=new Model();
        $sql="SELECT a.id,b.teacher,c.sourse,d.class,f.profession from sx_sourse_class_teacher a LEFT JOIN sx_teacher b on a.teacher_id=b.id LEFT JOIN sx_sourse c on a.sourse_id=c.id LEFT JOIN sx_class d on a.class_id=d.id left join sx_profession f on f.id=d.profession_id where b.id=4;";
        $data=$model->query($sql);
        $this->assign(data, $data);
        $this->display();
    }
    public function addConsumable(){
        $sourse=I('get.sourse');
        $sct_id=I('get.sct_id');
        $this->assign(sourse,$sourse);
        $this->assign(sct_id,$sct_id);
        $modell=new Model();
        $data=$modell->query("SELECT a.*,b.*,a.id idd from sx_sct_consumablelist a LEFT JOIN sx_consumable_list b on a.list_id=b.id where a.suoshu_id=1 and a.sct_id=$sct_id");
        $dataa=$modell->query("SELECT a.*,b.*,a.id idd from sx_sct_consumablelist a LEFT JOIN sx_tool_list b on a.list_id=b.id where a.suoshu_id=2 and a.sct_id=$sct_id");
        $dataa=array_merge($data,$dataa);
        $this->assign(dataa,$dataa);
        $this->display();
    }

    public function quedingtianjia(){
        $data['sct_id']=I('post.sct_id');
        $data['list_id']=I('post.consumablelist');
        $namelist=I('post.namelist');
        $model=M('sct_consumablelist');
        $modell=new Model();
        $dataa=$modell->query("select id from sx_consumable_list where listname='{$namelist}'");
        $dataa=$dataa[0][id];
        if($dataa>0){
            $data['suoshu_id']=1;
            echo $dataaa=$model->add($data);
        }else{
            $data['suoshu_id']='2';
            echo $dataaa=$model->add($data);
        }
    }

    public function consumablApply(){
        if(IS_POST){
            $data=I('post.');
            $table=array_shift($data);
            $model=M("");
            $model->table("$table")->add($data);
            redirect(U('Consumable/showConsumable'),3,'申请成功，请等待实训处确认');
        }
        $sourse=I('get.sourse');
        $sct_id=I('get.sct_id');
        $this->assign(sourse,$sourse);
        $this->assign(sct_id,$sct_id);
        $this->display();
    }
    //单击删除行
    public function del_table()
    {
        $id = $_GET['id'];
        $teacherModel = D('sct_consumablelist');
        echo $teacherModel->where("id=$id")->delete();

    }
    //单击调取数据
    public function diaoqu_consumable(){
        $model=M('consumable_list');
        $data=$model->select();
        $modell=M('tool_list');
        $dataa=$modell->select();
        $data=array_merge($data,$dataa);
        $this->ajaxReturn($data);
    }
}
?>