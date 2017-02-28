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

class SourseController extends MyController
{
    public function showSourse()
    {
        $model=new Model();
        $sql="select a.*,b.profession,c.semester from sx_sourse as a left join sx_profession b on a.profession_id=b.id left join sx_semester c on a.semester_id=c.id order by profession asc,semester asc;";
        $data = $model->query($sql);
        $this->assign(data, $data);
        $this->display();
    }

    public function addSourse()
    {
        if (IS_POST) {
            $model = M('sourse');
            $model->profession_id = I('post.profession_id');
            $model->semester_id = I('post.semester_id');
            $model->sourse = I('post.sourse');
            if (isset($model->id)) {
                unset($model->id);
            }
            if ($model->add()) {
//                $this->success('添加成功', U('showClass'));
//                exit;
                redirect(U('showSourse'));
            } else {
                $this->error('添加失败');
            }
        }
        $model = M('profession');
        $data=$model->select();
        $this->assign(data,$data);
        $model = M('semester');
        $dataa=$model->select();
        $this->assign(dataa,$dataa);
        $this->display();

    }

    public function modsourse()
    {
        if(IS_POST){
            $model=M('sourse');
            $model->profession_id = I('post.profession_id');
            $model->id = I('post.id');
            $model->sourse = I('post.sourse');
            $model->semester_id = I('post.semester_id');

            if ($model->where("id=$model->id")->save()) {
                redirect(U('showSourse'));
                exit;
            } else {
                $this->error('修改失败');
            }

        }
        $id=I('get.id');
        $model = M('sourse');
        $data=$model->where("id=$id")->select();
        $this->assign(data,$data);
        $modell = M('profession');
        $dataa=$modell->select();
        $this->assign(dataa,$dataa);
        $model = M('semester');
        $dataaa=$model->select();
        $this->assign(dataaa,$dataaa);
        $this->display();
    }

    //单击删除行
    public function del_table()
    {
        $id = $_GET['id'];
        $Model = D('sourse');
        echo $Model->where("id=$id")->delete();

    }

}