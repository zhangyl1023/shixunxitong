<?php
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model
{
    //首页展示
    protected $_validate = array(
        array('priv_name', 'require', '权限名称不为空'),
        array('parent_id', 'number', '上级权限不合法')
    );
    //递归获取栏目数量
    public function getTree(){
        $arr=$this->select();
        return $this->_getTree($arr,$parent_id=0,$lev=0);
    }
    public function _getTree($arr,$parent_id=0,$lev=0){
        static $list=array();
        foreach($arr as $v){
            if($v['parent_id']==$parent_id){
                $v['lev']=$lev;
                $list[]=$v;
                $this->_getTree($arr,$v['id'],$lev+1);
            }
        }
        return $list;
    }
}