<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="50%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="4">权限列表</td>
                        <td class="tableNew" colspan="1" onclick="create()"><img src="/Public/img/新建.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="teachPlan_1">权限名称</td>
                        <td class="teachPlan_2">模块名称</td>
                        <td class="teachPlan_3">控制器名称</td>
                        <td class="teachPlan_4">方法名称</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php echo $v['priv_name']?></td>
                        <td class="teachPlan_2"><?php echo $v['module_name']?></td>
                        <td class="teachPlan_3"><?php echo $v['controller_name']?></td>
                        <td class="teachPlan_4"><?php echo $v['action_name']?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" id="<?php echo $v['id']?>">
                                <a href="<?php echo U('Privilege/modprivilege',array('suoshu'=>$v['suoshu'],'id'=>$v['id']));?>">编辑</a>
                            </span>
                            <span class="teachPlan_del" id="<?php echo $v['id']?>"
                                  onclick="del_table(this,<?php echo $v['id']?>,'<?php echo $v['suoshu']?>')">删除
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="clear"></div>

</body>
<script>
//    $(document).ready(function(){
//        var n=$('table tr').length;
//        if(n<=2){
//            var tr_Obj="<tr><td colspan='8'>暂无实训课程项目</td></tr>";
//            $('table').append(tr_Obj);
//        }
//    });
    function create(){
        window.location.href="<?php echo U('Privilege/addPrivilege');?>";
    }
//
    //删除行*************************************************************************************************************
//    function del_table(o, id, p) {
//        var trObj = $(o).parent().parent();
//        $.ajax({
//            type: 'get',
//            data: {id: id,suoshu : p},
//            url: '<?php echo U("del_table");?>',
//            success: function (msg) {
//                if (msg > 0) {
//                    trObj.remove();
//                }
//            }
//        });
//    }
    //END***************************************************************************************************************

</script>
</html>