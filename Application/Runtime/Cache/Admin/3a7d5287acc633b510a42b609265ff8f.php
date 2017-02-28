<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="50%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="4"><?php echo $v['teacher'];?>王五老师，您的课程：</td>
                        </td>
                    </tr>
                    <tr>
                        <td class="teachPlan_4">专业</td>
                        <td class="teachPlan_1">班级</td>
                        <td class="teachPlan_2">课程</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_3"><?php echo $v['profession'];?></td>
                        <td class="teachPlan_1"><?php echo $v['class']?></td>
                        <td class="teachPlan_2"><?php echo $v['sourse']?></td>
                        <td class="teachPlan_8">
                            <span style="width:90%" class="teachPlan_ope" id="<?php echo $v['id']?>">
                                <a href="<?php echo U('Consumable/addConsumable',array('sct_id'=>$v['id'],'sourse'=>$v['sourse']));?>">编辑课程材料清单</a>
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
    //删除行***************假删除****************************************************************************************
    function del_table(o, p) {
        var trObj = $(o).parent().parent();
        $.ajax({
            type: 'get',
            data: {id: p},
            url: '<?php echo U("del_table")?>',
            success: function (msg) {
                if (msg > 0) {
                    trObj.html("");
                }
            }
        });
    }
    //END***************************************************************************************************************

    //单击新建表格********************************************************************************************************
    var tableObj;
    var new_tr;
    function create_table(o) {
        tableObj = $(o).parent().parent();
        if (tableObj.find('input').length > 0) {
            $("input").focus();
            return false;
        }
        new_tr = $('<tr class="hg"><td class="teachPlan_1"><input type="text" name="tianjia"></td><td class="teachPlan_8"><span class="teachPlan_ope" onclick="queding(this)" style="background-color: #2015c0">确定</span><span class="teachPlan_del" onclick="quxiao(this)" style="background-color:#6e043c">取消</span></td></tr>');
        new_tr.appendTo(tableObj);
        $("input[name=tianjia]").focus();
    }
    function queding() {
        var semester = $('input[name=tianjia]').val();
        if (semester.replace(/(^s*)|(s*$)/g, "").length == 0) {
            alert('不能为空');
        }
        $.ajax({
            type: 'post',
            data: {field: semester},
            url: '<?php echo U("create_table")?>',
            success: function (msg) {
                //msg返回值是修改数据库的结果
                if (msg > 0) {
                    window.location.href = "<?php echo U('showSemester');?>";
                }
            }
        });
    }
    function quxiao() {
        window.location.href = "<?php echo U('showSemester');?>";
    }
    //END***************************************************************************************************************
</script>

<link rel="stylesheet" type="text/css" href="/Public/css/index.css"/>
<!--</html>-->