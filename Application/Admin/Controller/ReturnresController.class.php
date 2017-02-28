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

class ReturnresController extends MyController
{
    public function showReturnres(){
        $model=new Model();
        $data=$model->query("select a.*,c.sourse,d.teacher from sx_consumable_temp a LEFT JOIN sx_sourse_class_teacher b on a.sct_id=b.id 
LEFT JOIN sx_sourse c on b.sourse_id=c.id 
LEFT JOIN sx_teacher d on b.teacher_id=d.id");
        foreach($data as $k=>$v){
            $data[$k]['suoshu']='sx_consumable_temp';
        }
        $modell=new Model();
        $dataa=$modell->query("select a.*,c.sourse,d.teacher from sx_tool_temp a LEFT JOIN sx_sourse_class_teacher b on a.sct_id=b.id 
LEFT JOIN sx_sourse c on b.sourse_id=c.id 
LEFT JOIN sx_teacher d on b.teacher_id=d.id");
        foreach($dataa as $a =>$v){
            $dataa[$a]['suoshu']='sx_tool_temp';
        }
        $data=array_merge($data,$dataa);
        $this->assign(data,$data);
        $this->display();
    }

    //单击删除行
    public function del_table()
    {
        $id =I('get.id');
        $suoshu = I('get.suoshu');
        $model =M('consumable_temp');
        $data=$model->table("$suoshu")->where("id=$id")->delete();
        echo $data;
    }
    public function modReturnres(){
        if(IS_POST){
            $data=I('post.');
            $table=array_shift($data);
            $model=M('consumable_list');
            $data=$model->table("$table")->add($data);
            redirect(U('showReturnres'),5,已将此物品添加至仓库清单);
        }
        $suoshu=I('get.suoshu');
        $id=I('get.id');
        $model=M('consumable_temp');
        $data=$model->table("$suoshu")->where("id=$id")->select();
        $this->assign(data,$data);
        $this->assign(suoshu,$suoshu);
        $this->display();
    }

    public function addSemesterPlan()
    {
        if (IS_POST) {
            $model = M('semester_plan');
            if (isset($model->id)) {
                unset($model->id);
            }
            $model->title = I('post.title');
            $model->content = I('post.content');
            $model->profession = I('post.professionPlan');
            $model->class = I('post.class');
            $model->author = I('post.author');
            $model->semester_id = I('semester_id');
            $model->add_time = time();
            if ($model->add()) {
                $this->success('添加成功', U('showSemesterPlan'));
                exit;
            } else {
                $this->error('添加失败，请联系管理员');
            }
        }
//        $semesterPlanModel = M('semester_plan');
//        $data = $semesterPlanModel->select();
//        $this->assign(data, $data);
        $professionModel = M('profession');
        $professionData = $professionModel->select();
        $this->assign(professionData, $professionData);
        $classModel = M('class');
        $classData = $classModel->select();
        $this->assign(classData, $classData);
        $teacherModel = M('teacher');
        $teacherData = $teacherModel->select();
        $this->assign(teacherData, $teacherData);
        $semesterModel = M('semester');
        $semesterData = $semesterModel->select();
        $this->assign(semesterData, $semesterData);
        $sourseModel = M('sourse');
        $sourseData = $sourseModel->select();
        $this->assign(sourseData, $sourseData);
        $this->display();
    }
    //二级联动
    public function get_sourse(){
        $model=new model();
    }

    public function modSemesterPlan()
    {
        if (IS_POST) {
            print_r(I('post.'));
            $model = M('semester_plan');
            $model->title = I('post.title');
            $model->content = I('post.content');
            $model->profession = I('post.professionPlan');
            $model->class = I('post.class');
            $model->author = I('post.author');
            $model->semester_id = I('semester_id');
            $model->add_time = time();
            $id = I('id');
            if ($model->where("id=$id")->save()) {
                $this->success('修改成功', U('showSemesterPlan'));
                exit;
            } else {
                $this->error('修改失败');
            }
        }
        $model = M('semester_plan');
        $id = I('get.id');
        $data = $model->query("select a.*,b.semester from sx_semester_plan a left join sx_semester b on a.semester_id=b.id where a.id=$id and a.status=1;");
        $semestermodel = M('semester');
        $dataa = $semestermodel->select();
        $this->assign(dataa, $dataa);
        $this->assign(data, $data);
        $this->display();
    }
}