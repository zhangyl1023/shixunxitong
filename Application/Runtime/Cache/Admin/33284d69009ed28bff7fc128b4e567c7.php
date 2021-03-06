<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="80%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="6">工量具库存</td>
                        <!--<td class="tableNew" colspan="1" onclick="create()"><img src="/Public/img/新建.png"/>-->
                        </td>
                    </tr>
                    <tr>
                        <th class="teachPlan_1">耗材</th>
                        <th class="teachPlan_1">库存</th>
                        <th class="teachPlan_2">单位</th>
                        <th class="teachPlan_3">品牌</th>
                        <th class="teachPlan_4">型号</th>
                        <th class="teachPlan_6">添加时间</th>
                        <th class="teachPlan_8">操作</th>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php echo $v['listname']?></td>
                        <td class="teachPlan_1"><?php echo $v['numb']?></td>
                        <td class="teachPlan_1"><?php echo $v['unit']?></td>
                        <td class="teachPlan_1"><?php echo $v['brand']?></td>
                        <td class="teachPlan_1"><?php echo $v['version']?></td>
                        <td class="teachPlan_6"><?php echo "20".date('y-m-d h:i:s',$v['add_time'])?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" style="width:90%" id="<?php echo $v['id']?>"
                                  onclick="changelist(this)">调整库存</span>
                            <span class="teachPlan_del" id="<?php echo $v['id']?>"
                                  onclick="quxc(this)" style="display: none;">取消
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
    var numb;
    var id;
    var numbe;
    var changelistt;
    function changelist(o) {
        if($(o).parent().parent().parent().find('input').length>0){
            return false;
        }
        id = $(o).attr('id');
        numb = $(o).parent().parent().children('td:eq(1)').html();
        changelistt = $(o).attr('onclick');
        $(o).parent().parent().children('td:eq(1)').html("");
        var inputObj = "<input type='text' name='numb' value='" + numb + "'>";
        $(o).parent().parent().children('td:eq(1)').append(inputObj);
        $('input[name=numb]').focus();
        $(o).html('确定');
        $(o).attr('onclick', 'qtdy(this)').css('width', '40%');
        //显示取消键
        $(o).parent().children(':last').css('display', 'block');
    }
    function qtdy(o) {
        id = $(o).attr('id');
        numbe = $('input[name=numb]').val();
        $.ajax({
            type: 'get',
            data: {id: id, numb: numbe},
            url: '<?php echo U("qtdy")?>',
            success: function (msg) {
                if (msg > 0) {
                    $(o).parent().parent().children('td:eq(1)').html(numbe);
                    //隐藏取消
                    $(o).parent().children(':last').css('display', 'none');
                    $(o).css('width', '90%');
                    $(o).attr('onclick', 'changelist(this)');
                    $(o).html('调整库存');
                }
            }
        });
    }
    function quxc(o) {
        $(o).parent().parent().children('td:eq(1)').html(numb);
        $(o).css('display', 'none');
        $(o).parent().children(':first').css('width','90%');
        $(o).parent().children(':first').html('调整库存');
        $(o).parent().children('span:eq(0)').attr('onclick', 'changelist(this)');
    }

</script>
</html>