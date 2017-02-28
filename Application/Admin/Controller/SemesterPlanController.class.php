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

class SemesterPlanController extends MyController
{
    public function showSemesterPlan()
    {
        $model = new Model();
//        $sql = "SELECT a.id sourseid,a.sourse,b.id classid,b.class,c.profession,d.semester from sx_sourse as a,sx_class as b,sx_profession as c,sx_semester as d where a.profession_id=b.profession_id and a.profession_id=c.id and a.semester_id=d.id order by a.profession_id desc,b.class asc,d.semester asc;";
//        $sql="SELECT a.*,b.*,c.profession,d.semester,a.id sourseid,b.id classid from sx_sourse as a,sx_class as b,sx_profession as c,sx_semester as d where a.profession_id=b.profession_id and a.profession_id=c.id and a.semester_id=d.id order by c.profession asc,b.class asc,d.semester asc";
//        $sql="SELECT a.*,b.*,c.profession,d.semester,e.teacher,a.id sourseid,b.id classid from
//sx_sourse as a,sx_class as b,sx_profession as c,sx_semester as d,sx_teacher as e,sx_sourse_class_teacher as f
//where a.profession_id=b.profession_id
//and a.profession_id=c.id
//and a.semester_id=d.id
//and f.class_id=b.id
//and f.sourse_id=a.id
//and f.teacher_id=e.id
//order by c.profession asc,b.class asc,d.semester asc";
        $sql="select a.*,b.*,c.profession,d.semester,f.teacher,a.id sourseid,b.id classid FROM sx_sourse as a cross join sx_class as b on a.profession_id=b.profession_id 
LEFT JOIN sx_profession as c on c.id=a.profession_id 
LEFT JOIN sx_semester as d on d.id=a.semester_id 
LEFT JOIN sx_sourse_class_teacher as e on e.sourse_id=a.id and e.class_id=b.id 
LEFT JOIN sx_teacher as f on f.id=e.teacher_id 
order by c.profession asc,b.class asc,d.semester asc;";
        $data = $model->query($sql);
//        echo "<pre>";
//        print_r($data);die;
        $this->assign(data, $data);
        $this->display();
    }
    //分配老师
    public function search_teacher(){
//        $sourseid=I('get.sourseidd');
//        $classid.=I("get.classidd");
        $model=M('teacher');
        $data=$model->select();
        $this->ajaxReturn($data);
//        while($rel=mysqli_fetch_assoc($data)){
//            $data[]=$rel;
//        }
//        $dataa=json_encode($data);
//        echo $dataa;
    }

    //保存分配课程的教师
    public function save_fenpei(){
        $data['sourse_id']=I('get.sourse_idd');
        $data['class_id']=I("get.class_idd");
        $data['teacher_id']=I("get.teacher_idd");
        $model=M('sourse_class_teacher');
        $dataa=$model->add($data);
        $this->ajaxReturn($dataa);
    }
    public function mod_fenpei(){
        $sourse_id=I('get.sourse_idd');
        $class_id=I("get.class_idd");
        $teacher_id=I("get.teacher_idd");
        $model=M('sourse_class_teacher');
        $dataa=$model->where("sourse_id=$sourse_id and class_id=$class_id")->setField(teacher_id,"$teacher_id");
        $this->ajaxReturn($dataa);
    }

    //单击删除行  假删除
    public function del_table()
    {
        $id = $_GET['id'];
        $teacherModel = M('semester_plan');
        echo $teacherModel->where("id=$id")->setField('status', '0');
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