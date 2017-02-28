<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="460px" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="2" style="width: 60%">专业班级</td>
                        <td class="tableNew" colspan="1" onclick="window.location.href='<?php echo U("class/addClass");?>'"><img src="/Public/img/新建.png"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="teachPlan_1">专业</th>
                        <th class="teachPlan_2">班级</th>
                        <th class="teachPlan_8">操作</th>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <td class="teachPlan_1"><?php echo $v['profession']?></td>
                        <td class="teachPlan_1"><?php echo $v['class']?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" id="<?php echo $v['id']?>"
                                  onclick="window.location.href='<?php echo U("class/modClass",array('id'=>$v['id']));?>'">
                                编辑</span>
                            <span class="teachPlan_del" id="<?php echo $v['id']?>"
                                  onclick="del_table(this,<?php echo $v['id']?>)">删除</span>
                            <!--<a href="<?php echo U('Semester/delSemester',array('id'=>$v['id'])) ?>">删除</a>-->
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

    //删除行*************************************************************************************************************
    function del_table(o, id) {
        var trObj = $(o).parent().parent();
        $.ajax({
            type: 'get',
            data: {id: id},
            url: '<?php echo U("del_table")?>',
            success: function (msg) {
                if (msg > 0) {
                    trObj.html("");
                }
            }
        });
    }

</script>

<link rel="stylesheet" type="text/css" href="/Public/css/index.css"/>
<!--</html>-->