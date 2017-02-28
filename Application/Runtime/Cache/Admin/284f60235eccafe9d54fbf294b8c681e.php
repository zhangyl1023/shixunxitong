<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="80%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="7">耗材、工量具审批</td>
                        <!--<td class="tableNew" colspan="1" onclick="create()"><img src="/Public/img/新建.png"/>-->
                        </td>
                    </tr>
                    <tr>
                        <td class="teachPlan_1">课程</td>
                        <td class="teachPlan_2">项目名</td>
                        <td class="teachPlan_3">内容</td>
                        <td class="teachPlan_4">申请教师</td>
                        <td class="teachPlan_5">耗材、工量具</td>
                        <td class="teachPlan_6">数量</td>
                        <td class="teachPlan_6">添加时间</td>
                        <td class="teachPlan_6">状态</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php echo $v['sourse']?></td>
                        <td class="teachPlan_2"><?php echo $v['itemname']?></td>
                        <td class="teachPlan_3"><?php echo $v['content']?></td>
                        <td class="teachPlan_4"><?php echo $v['teacher']?></td>
                        <td class="teachPlan_5"><?php echo $v['listname']?></td>
                        <td class="teachPlan_6"><?php echo $v['numb']?></td>
                        <td class="teachPlan_6"><?php echo "20".date('y-m-d h:i:s',$v['add_time'])?></td>
                        <td class="teachPlan_6" style="color:<?php if($v['status']==44){echo 'red';}else if($v['status']==4){echo '#0CDC25';}?>"><?php if($v['status']==3){echo '申请中';}else if($v['status']==4){echo '申请通过';}else if($v['status']==44){echo '申请退回';}?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" id="<?php echo $v['id']?>" onclick="<?php if($v['status']==4){echo 'cancel';}?>pass1(this,<?php echo $v['id'];?>,'<?php echo $v['suoshu']?>')">
                                <?php if($v['status']==3){echo '通过';}else if($v['status']==4){echo '取消通过';}else if($v['status']==44){echo '通过';}?>
                            </span>
                            <span class="teachPlan_del" id="<?php echo $v['id']?>"
                                  onclick="<?php if($v['status']==44){echo 'cancel';}?>back1(this,<?php echo $v['id']?>,'<?php echo $v['suoshu']?>')"><?php if($v['status']==3){echo '退回';}else if($v['status']==4){echo '退回';}else if($v['status']==44){echo '取消退回';}?>
                            </span>
                        </td>
                        <!--<input type="hidden" name="suoshu" value="<?php echo $v['suoshu'];?>">-->
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
    $(document).ready(function(){
        var n=$('table tr').length;
        if(n<=2){
            var tr_Obj="<tr><td colspan='9'>暂无申请</td></tr>";
            $('table').append(tr_Obj);
        }
    });
    function pass1(o,p,q){
        $.ajax({
           type:'get',
            data:{id:p,suoshu:q},
            url:'<?php echo U("pass1");?>',
            success:function(msg){
               if(msg>0){
                   window.location.reload();
//                   $(o).parent().parent().children('td:eq(7)').html('申请通过');
//                   $(o).html('取消通过');
//                   $(o).attr('onclick','cancel'+$(o).attr('onclick'));
               }
            }
        });
    }
    function cancelpass1(o,p,q){
        $.ajax({
            type:'get',
            data:{id:p,suoshu:q},
            url:'<?php echo U("cancelpass1");?>',
            success:function(msg){
                if(msg>0){
                    window.location.reload();

                }
            }
        });
    }
    function back1(o,p,q){
        $.ajax({
            type:'get',
            data:{id:p,suoshu:q},
            url:'<?php echo U("back1");?>',
            success:function(msg){
                if(msg>0){
                    window.location.reload();

                }
            }
        });
    }
    function cancelback1(o,p,q){
        $.ajax({
            type:'get',
            data:{id:p,suoshu:q},
            url:'<?php echo U("cancelback1");?>',
            success:function(msg){
                if(msg>0){
                    window.location.reload();
                }
            }
        });
    }
//    function create(){
//        window.location.href="<?php echo U('SourseItem/addSourseItem');?>";
//    }

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