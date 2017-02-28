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

class ClassController extends MyController
{
    public function showClass()
    {
        $model=new Model();
        $sql="select a.profession,b.* from sx_profession as a right join sx_class b on a.id=b.profession_id order by profession asc;";
        $data = $model->query($sql);
        $this->assign(data, $data);
        $this->display();
    }

    public function addClass()
    {
        if (IS_POST) {
            $model = M('class');
            $model->profession_id = I('post.profession_id');
            $model->class = I('post.class');
            if (isset($model->id)) {
                unset($model->id);
            }
            if ($model->add()) {
//                $this->success('添加成功', U('showClass'));
//                exit;
                redirect(U('showClass'));
            } else {
                $this->error('添加失败');
            }
        }
        $model = M('profession');
        $data=$model->select();
        $this->assign(data,$data);
        $this->display();

    }

    public function modClass()
    {
        if(IS_POST){
            $model=M('class');
            $model->profession_id = I('post.profession_id');
            $model->id = I('post.id');
            $model->class = I('post.class');

            if ($model->where("id=$model->id")->save()) {
                redirect(U('showClass'));
                exit;
            } else {
                $this->error('修改失败');
            }

        }
        $model = M('class');
        $id=I('get.id');
        $data=$model->where("id=$id")->select();
        $modell = M('profession');
        $dataa=$modell->select();
        $this->assign(data,$data);
        $this->assign(dataa,$dataa);
        $this->display();
    }

    //单击删除行
    public function del_table()
    {
        $id = $_GET['id'];
        $Model = D('class');
        echo $Model->where("id=$id")->delete();

    }

}