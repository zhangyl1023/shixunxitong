<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="80%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="6">材料申请列表</td>
                        <!--<td class="tableNew" colspan="1" onclick="createProfessionPlan()"><img src="/Public/img/新建.png"/>-->
                        <!--</td>-->
                    </tr>
                    <tr>
                        <td class="teachPlan_1">耗材、工量具</td>
                        <td class="teachPlan_1">课程</td>
                        <td class="teachPlan_1">申请教师</td>
                        <td class="teachPlan_1">名称</td>
                        <td class="teachPlan_2">数量</td>
                        <td class="teachPlan_3">单位</td>
                        <td class="teachPlan_4">品牌</td>
                        <td class="teachPlan_5">型号</td>
                        <td class="teachPlan_6">添加时间</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php if($v['suoshu']=='sx_consumable_temp'){echo '耗材';}else{echo '工量具';};?></td>
                        <td class="teachPlan_1"><?php echo $v['sourse']?></td>
                        <td class="teachPlan_1"><?php echo $v['teacher']?></td>
                        <td class="teachPlan_1"><?php echo $v['listname']?></td>
                        <td class="teachPlan_2"><?php echo $v['numb']?></td>
                        <td class="teachPlan_3"><?php echo $v['unit']?></td>
                        <td class="teachPlan_4"><?php echo $v['brand']?></td>
                        <td class="teachPlan_5"><?php echo $v['version']?></td>
                        <td class="teachPlan_6"><?php echo "20".date('y-m-d h:i:s',$v['add_time'])?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" id="<?php echo $v['id']?>">
                                <a href="<?php echo U('Returnres/modReturnres',array('suoshu'=>$v['suoshu'],'id'=>$v['id']));?>">编辑</a>
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
    $(document).ready(function(){
        var n=$('table tr').length;
        if(n<=2){
            var tr_Obj="<tr><td colspan='10'>暂无申请</td></tr>";
            $('table').append(tr_Obj);
        }
    });
    //删除行*************************************************************************************************************
    function del_table(o, id, p) {
        var trObj = $(o).parent().parent();
        $.ajax({
            type: 'get',
            data: {id: id,suoshu : p},
            url: '<?php echo U("del_table");?>',
            success: function (msg) {
                if (msg > 0) {
                    trObj.remove();
                }
            }
        });
    }
    //END***************************************************************************************************************

</script>
</html>