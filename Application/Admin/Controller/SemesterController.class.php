<?php
/**
 * Created by PhpStorm.
 * User: yingliang
 * Date: 2017/1/19
 * Time: 16:57
 */
namespace Admin\Controller;

use Think\Controller;

class SemesterController extends MyController
{
    public function showSemester()
    {
        $model = M('Semester');
        $data = $model->select();
        $this->assign(data, $data);
        $this->display();
    }

    public function addSemester()
    {
        if (IS_POST) {
            $model = M('semester');
            $model->semester = I('post.semester');
            if (isset($model->id)) {
                unset($model->id);
            }
            if ($model->add()) {
                $this->success('添加成功', U('showSemester'));
                exit;
            } else {
                $this->error('添加失败');
            }
        }
        $this->display();

    }

    public function modSemester()
    {
        if (IS_POST) {
            $model = M('Semester');
            $model->semester = I('post.semester');
            $model->id = I('post.id');

            if ($model->where("id=$model->id")->save()) {
                $this->success('修改成功', U('showSemester'));
                exit;
            } else {
                $this->error('修改失败');
            }

        }
        $model = M('Semester');
        $id = I('get.id');
        $data = $model->where("id=$id")->select();
        $this->assign(data, $data);
        $this->display();
    }

    public function delSemester()
    {
        $model = M('Semester');
        $id = I('get.id');
        $data = $model->where("id=$id")->delete();
        if ($data == 1) {
            $this->success('删除成功', U('showSemester'));
        } else {
            $this->error('删除失败，请联系管理员');
        }
    }

    //单击可以编辑的单元格
    public function edit_table()
    {
        //接收参数
        $id = $_GET['id'];
//        $field = $_GET['field'];
        $values = $_GET['values'];//
        $semestermodeledit = D('semester');
        if (!empty($values)) {
            $data=$semestermodeledit->where("id=$id")->setField('semester', $values);
            echo $data;
            exit;
        } else {
            echo '0';
        }
    }

    //单击删除行
    public function del_table()
    {
        $id = $_GET['id'];
        $semestermodel = D('semester');
        echo $semestermodel->where("id=$id")->delete();

    }

    public function create_table()
    {
        $data['semester'] = $_POST['field'];
        $semestermodel = D('semester');
        if (empty($data['semester'])) {
            echo '0';
            exit;
        }
        echo $semestermodel->add($data);
    }
}
