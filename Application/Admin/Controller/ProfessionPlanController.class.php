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

class ProfessionPlanController extends MyController
{
    //展示专业计划
    public function showProfessionPlan()
    {
//        $model = M('profession_plan');
        $model = new Model();
        $sql="select a.*,b.profession from sx_profession_plan a left join sx_profession b on a.profession_id=b.id where a.status=1;";
        $data = $model->query($sql);
//        $data = $model->where('status=1')->select();
        $this->assign('data', $data);
        $this->display();
    }

    //单击删除行  假删除
    public function del_table()
    {
        $id = $_GET['id'];
        $teacherModel = M('profession_plan');
        echo $teacherModel->where("id=$id")->setField('status','0');

    }

    //添加专业计划
    public function addProfessionPlan()
    {
        if (IS_POST) {
            $model = M('profession_plan');
            $model->title = I('post.title');
            $model->author = I('post.author');
            $model->profession_id = I('post.profession_id');
            $model->class = I('post.class');
            $model->content = I('post.content');
            $model->add_time = time();
            if (isset($model->id)) {
                unset($model->id);
            }
            if ($model->add()) {
                $this->success('添加成功', U('showProfessionPlan'));
                exit;
            } else {
                $this->error('添加失败');
            }
        }
        $model=M('profession');
        $data=$model->select();
        $this->assign(data,$data);
        $this->display();
    }

    //删除专业计划
    public function delProfessionPlan()
    {
        $model = M('profession_plan');
        $id = I('get.id');
        //$data=$model->where("id=$id")->setField('status','1');
        //echo U('Profession/showProfession');

        if ($data = $model->where("id=$id")->setField('status', '0')) {
            $this->success('删除成功', U('showProfessionPlan'));
        }else{
            $this->error('删除失败，请联系管理员');
        };
    }

    //修改专业计划
    public function modProfessionPlan()
    {
        if(IS_POST){
            $model = M('profession_plan');
            $model->title = I('post.title');
            $model->author = I('post.author');
            $model->profession_id = I('post.profession_id');
            $model->class = I('post.class');
            $model->content = I('post.content');
            $model->add_time = time();
            $model->id = I('post.id');

            if ($model->where("id=$model->id")->save()) {
                $this->success('修改成功', U('showProfessionPlan'));
                exit;
            } else {
                $this->error('修改失败');
            }

        }
        $model=M('profession_plan');
        $id=I('get.id');//
        $data=$model->where("id=$id")->select();
        //echo "<pre>";
        //print_r($data);die;
        $modell=M('profession');
        $dataa=$modell->select();
        $this->assign(data,$data);
        $this->assign(dataa,$dataa);
        $this->display();
    }
}
?>