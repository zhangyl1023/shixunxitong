<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="80%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="6">实训课程项目填报</td>
                        <td class="tableNew" colspan="1" onclick="create()"><img src="/Public/img/新建.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="teachPlan_1">课程</td>
                        <td class="teachPlan_1">项目名</td>
                        <td class="teachPlan_2">内容</td>
                        <td class="teachPlan_3">耗材</td>
                        <td class="teachPlan_4">工量具</td>
                        <td class="teachPlan_6">添加时间</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php echo $v['sourse']?></td>
                        <td class="teachPlan_1"><?php echo $v['itemname']?></td>
                        <td class="teachPlan_1"><?php echo $v['content']?></td>
                        <td class="teachPlan_2">
                            <?php foreach($v['consumable'] as $vv){ echo '<a style="color:'; if($vv['status'] > 10){echo 'red';}else if($vv['status'] == 4){echo '#0CDC25';}else if($vv['status'] == 6){echo 'blue';}else if($vv['status'] == 5){echo 'blue';}; echo '">'; echo $vv['listname'];echo $vv['numb']; echo $vv['unit'].'&nbsp;&nbsp;'; if($vv['status']==1 ){echo '申请中';}else if($vv['status']==2){echo '系主任申请通过';}else if($vv['status']==3){echo '实训处申请通过';}else if($vv['status']==5){echo '已领取';}else if($vv['status']==4){echo '待领取';}else if($vv['status']==6){echo '已归还';}else if($vv['status']>10){echo '申请退回';}; echo '</a>';echo '<br>'; }?>
                        </td>
                        <td class="teachPlan_3">
                            <?php foreach($v['tool'] as $vv){ echo '<a style="color:'; if($vv['status']==2){echo '#0CDC25';}else if($vv['status']==22){echo 'red';}; echo '">'; echo $vv['listname'];echo $vv['numb'];echo $vv['unit'].'&nbsp;&nbsp;';if($vv['status']==1 ){echo '申请中';}else if($vv['status']==2){echo '系主任申请通过';}else if($vv['status']==3){echo '实训处申请通过';}else if($vv['status']==5){echo '已领取';}else if($vv['status']==4){echo '待领取';}else if($vv['status']==6){echo '已归还';}else if($vv['status']>10){echo '申请退回';};echo '</a>';echo '<br>';}?>
                        </td>
                        <td class="teachPlan_6"><?php echo "20".date('y-m-d h:i:s',$v['add_time'])?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" id="<?php echo $v['id']?>">
                                <a href="<?php echo U('Returnres/modReturnres',array('suoshu'=>$v['suoshu'],'id'=>$v['id']));?>">编辑</a>
                            </span>
                            <span class="teachPlan_del" id="<?php echo $v['id']?>"
                                  onclick="del_table(this,<?php echo $v['id']?>,'<?php echo $v['suoshu']?>')" style="display:<?php if((time()-$v['add_time'])>300){echo 'none';}else{echo 'block';};?>">删除
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
    $(document).ready(function(){
        var n=$('table tr').length;
        if(n<=2){
            var tr_Obj="<tr><td colspan='7'>暂无实训课程项目</td></tr>";
            $('table').append(tr_Obj);
        }
    });
    function create(){
        window.location.href="<?php echo U('SourseItem/addSourseItem');?>";
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