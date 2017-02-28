<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <form action="/Admin/Consumable/addConsumable" method="post">
                <table width="50%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="2" style="width: 60%">为《<?php echo $sourse;?>》申请材料清单</td>
                        <td class="tableNew" colspan="1" onclick="create_table(this)"><img src="/Public/img/新建.png"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="teachPlan_1">课程</th>
                        <th class="teachPlan_2"><?php echo $sourse;?></th>
                        <th class="teachPlan_8" style="width:10%;">操作</th>
                    </tr>
                    <?php foreach($dataa as $vv){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php if($vv['suoshu_id']==1){echo '已选耗材：';}else{echo '已选工量具：';}?></td>
                        <td class="teachPlan_2"><?php echo $vv['listname']."    ";echo $vv['unit']."    ";echo $vv['brand']."    ";echo $vv['version'];?></td>
                        <td class="teachPlan_8">
                            <span style="width:90%" class="teachPlan_del" id="<?php echo $vv['id']?>"
                                  onclick="del_table(this,<?php echo $vv['idd']?>)">删除</span>
                            <!--<a href="<?php echo U('Semester/delSemester',array('id'=>$v['id'])) ?>">删除</a>-->
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3"><a href="<?php echo U('consumablApply',array('sourse'=>$sourse,'sct_id'=>$sct_id));?>">添加列表没有，点击此处申请</a></td>
                    </tr>
                    <tr><td colspan="3" style="text-align: right;border:none;font-size: 18px;"><span class="table_submit" onclick="back()"><a href="##">返回</a></span></td></tr>
                    <input type="hidden" name="sct_id" value="<?php echo $sct_id;?>">
                </table>
                </form>
            </div>
        </div>
    </section>
</div>

<div class="clear"></div>

</body>
<script>

    //删除行*************************************************************************************************************
    function del_table(o, id) {
        var trObj = $(o).parent().parent();
        $.ajax({
            type: 'get',
            data: {id: id},
            url: '<?php echo U("del_table")?>',
            success: function (msg) {
                if (msg > 0) {
                    trObj.remove();
                }
            }
        });
    }
    function back() {
        window.location.href = "<?php echo U('consumable/showConsumable');?>"
    }
    //单击新建表格********************************************************************************************************
    var tableObj;
    var new_tr;
    function create_table(o) {
        //如果td里面有select框在，则就return false;
        var selectObj = $(o).parent().parent().parent().children().children();
        var sdf = selectObj.find('select').length;
        if (sdf >= 1) {
            return false;
        }
        tableObj = $(o).parent().parent();
        var temp = $(o).parent().parent().children('tr:eq(-1),tr:eq(-2)');
        $(o).parent().parent().children('tr:last').remove();
        new_tr = $('<tr class="hg"><td class="teachPlan_1">选择耗材、工量具：</td><td class="teachPlan_1"><select name="consumablelist_id" id="xuanze"></select></td><td class="teachPlan_8"><span class="teachPlan_ope" onclick="queding(this)">确定</span><span class="teachPlan_del" onclick="quxiao(this)">取消</span></td></tr>');
        new_tr.appendTo(tableObj);
        temp.appendTo(tableObj);
        $.ajax({
            type: 'post',
            url: '<?php echo U("diaoqu_consumable")?>',
            success: function (msg) {
                var optionss = '';
                for (var i = 0; i < msg.length; i++) {
                    optionss += '<option value="' +msg[i].id+'">'+ msg[i].listname +'</option>';
                }
                $('#xuanze').append(optionss);
            }
        });
    }
    function queding() {
        var namelistt=$('option:selected').html();
        var sct_idd=$('input[name=sct_id]').val();
        var consumablelistt=$('option:selected').val();
        $.ajax({
           type:'post',
            data:{sct_id:sct_idd,consumablelist:consumablelistt,namelist:namelistt},
            url:'<?php echo U('quedingtianjia')?>',
            success:function (msg){
               if(msg>0){
                   window.location.reload();
               }
            }
        });
    }
    function quxiao(o) {
        $(o).parent().parent().remove();
    }
    //END***************************************************************************************************************

</script>