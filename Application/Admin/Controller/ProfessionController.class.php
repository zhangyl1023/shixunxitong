<?php
/**
 * Created by PhpStorm.
 * User: yingliang
 * Date: 2017/1/19
 * Time: 16:57
 */
namespace Admin\Controller;

use Think\Controller;

class ProfessionController extends MyController
{
    public function showProfession()
    {
        $model = M('Profession');
        $data = $model->select();
        $this->assign(data, $data);
        $this->display();
    }

    public function addProfession()
    {
        if (IS_POST) {
            $model = M('Profession');
            $model->profession = I('post.profession');
            if (isset($model->id)) {
                unset($model->id);
            }
            if ($model->add()) {
                $this->success('添加成功', U('showProfession'));
                exit;
            } else {
                $this->error('添加失败');
            }
        }
        $this->display();

    }

    public function modProfession()
    {
        if(IS_POST){
            $model=M('Profession');
            $model->profession = I('post.profession');
            $model->id = I('post.id');

            if ($model->where("id=$model->id")->save()) {
                $this->success('修改成功', U('showProfession'));
                exit;
            } else {
                $this->error('修改失败');
            }

        }
        $model = M('Profession');
        $id=I('get.id');
        $data=$model->where("id=$id")->select();
        $this->assign(data,$data);
        $this->display();
    }

    public function delProfession()
    {
        $model = M('Profession');
        $id = I('get.id');
        $data = $model->where("id=$id")->delete();
        if ($data == 1) {
            $this->success('删除成功', U('showProfession'));
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
        $professionModel = D('profession');
        if (!empty($values)) {
            $data=$professionModel->where("id=$id")->setField('profession', $values);
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
        $professionModel = D('profession');
        echo $professionModel->where("id=$id")->delete();

    }

    public function create_table()
    {
        $data['profession'] = $_POST['field'];
        $professionModel = D('profession');
        if (empty($data['profession'])) {
            echo '0';
            exit;
        }
        echo $professionModel->add($data);
    }

}