<?php
/**
 * Created by PhpStorm.
 * User: yingliang
 * Date: 2017/1/19
 * Time: 16:57
 */
namespace Admin\Controller;

use Think\Controller;

class TeacherController extends MyController
{
    public function showTeacher()
    {
        $model = M('teacher');
        $data = $model->select();
        $this->assign(data, $data);
        $this->display();
    }

    //单击可以编辑的单元格
    public function edit_table()
    {
        //接收参数
        $id = $_GET['id'];
//        $field = $_GET['field'];
        $values = $_GET['values'];//
        $teacherModel = D('teacher');
        if (!empty($values)) {
            $data=$teacherModel->where("id=$id")->setField('teacher', $values);
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
        $teacherModel = D('teacher');
        echo $teacherModel->where("id=$id")->delete();
    }

    public function create_table()
    {
        $data['teacher'] = $_POST['field'];
        $teacherModel = D('teacher');
        if (empty($data['teacher'])) {
            echo '0';
            exit;
        }
        echo $teacherModel->add($data);
    }
}
