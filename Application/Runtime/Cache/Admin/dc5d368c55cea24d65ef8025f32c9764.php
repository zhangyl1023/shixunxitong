<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="80%" class="table teachPlan" id="geuu">
                    <tr>
                        <td class="tableName" colspan="4">学期教学计划</td>
                        <!--<td class="tableNew" colspan="1" onclick="createProfessionPlan()"><img src="/Public/img/新建.png"/>-->
                        </td>
                    </tr>
                    <tr>
                        <!--<td class="teachPlan_1">标题</td>-->
                        <!--<td class="teachPlan_2">内容</td>-->
                        <!--<td class="teachPlan_3">作者</td>-->
                        <td class="teachPlan_4">专业</td>
                        <td class="teachPlan_5">班级</td>
                        <td class="teachPlan_6">学期</td>
                        <td class="teachPlan_7">课程</td>
                        <td class="teachPlan_7">任课教师</td>
                        <td class="teachPlan_8">操作</td>
                    </tr>
                    <?php foreach($data as $v){ ?>
                    <tr class="hg">
                        <!--<td class="teachPlan_1"><?php echo $v['title']?></td>-->
                        <!--<td class="teachPlan_2"><?php echo $v['content']?></td>-->
                        <!--<td class="teachPlan_3"><?php echo $v['author']?></td>-->
                        <td class="teachPlan_4"><?php echo $v['profession']?></td>
                        <td class="teachPlan_5"><?php echo $v['class']?></td>
                        <td class="teachPlan_6"><?php echo $v['semester']?></td>
                        <td class="teachPlan_7"><?php echo $v['sourse']?></td>
                        <input type="hidden" name="sourseid" value="<?php echo $v['sourseid'];?>">
                        <input type="hidden" name="classid" value="<?php echo $v['classid'];?>">
                        <td class="teachPlan_7"><?php echo $v['teacher']?></td>
                        <td class="teachPlan_8">
                            <span class="teachPlan_ope" style="width:47%;<?php if(!empty($v['teacher'])){echo 'background-color:#e0e0e0';}?>" id="<?php echo $v['id']?>"
                                  onclick="fenpeijiaoshi(this,<?php echo $v['sourseid']?>,<?php echo $v['classid'];?>)">分配教师</span>
                            <span class="teachPlan_del" style="width:33%;<?php if(empty($v['teacher'])){echo 'background-color:#e0e0e0';}?>" id="<?php echo $v['id']?>"
                                  onclick="xqgljiaoshi(this,<?php echo $v['sourseid']?>,<?php echo $v['classid'];?>)">修改
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
    var jiaoshi;
    var onclickfenpeijiaoshi;
    var onclickxqgljiaoshi;
    function fenpeijiaoshi(o, p, q) {
        if ($(o).parent().parent().parent().find('select').length > 0) {
            return false;
        }
        if ($(o).parent().parent().children('td:eq(4)').html().length > 0) {
            return false;
        }
        jiaoshi = $(o).parent().parent().children('td:eq(4)').html();
        onclickxqgljiaoshi = $(o).parent().children('span:eq(1)').attr('onclick');
        onclickfenpeijiaoshi = $(o).attr('onclick');
        var fenpeiInputObj = $('<select name="teacher_id"></select>');
        $(o).parent().parent().children('td:eq(4)').append(fenpeiInputObj);
        $(o).html('确定');
        $(o).attr('onclick', 'qtdyfenpei(this)');
        $(o).parent().children('span:eq(1)').html('取消');
        $(o).parent().children('span:eq(1)').attr('onclick', 'quxcfenpei(this)');
        $(o).parent().children('span:eq(1)').css('background-color', 'rgba(255, 0, 0, 0.42)');
        var selectObj = '';
        $.ajax({
            type: 'get',
            data: {sourseidd: p, classidd: q},
            url: "<?php echo U('search_teacher');?>",
            dataType: 'json',
            success: function (msg) {
                for (var i = 0; i < msg.length; i++) {
                    selectObj += "<option value='" + msg[i].id + "'>" + msg[i].teacher + "</option>";
                }
                $('select[name=teacher_id]').append(selectObj);
            }
        });
    }
    function xqgljiaoshi(o, p, q) {
        if ($(o).parent().parent().parent().find('select').length > 0) {
            return false;
        }
        if ($(o).parent().parent().children('td:eq(4)').html().length == 0) {
            return false;
        }
        jiaoshi = $(o).parent().parent().children('td:eq(4)').html();
        onclickfenpeijiaoshi = $(o).parent().children('span:eq(0)').attr('onclick');
        onclickxqgljiaoshi = $(o).attr('onclick');
        jiaoshi = jiaoshi.replace(/(\s*$)/g, "");
        $(o).parent().parent().children('td:eq(4)').html("");
        if (jiaoshi.length > 0) {
            var fenpeiInputObj = $('<select name="teacher_id"></select>');
            $(o).parent().parent().children('td:eq(4)').append(fenpeiInputObj);
            $(o).html('取消');
            $(o).attr('onclick', 'quxc(this)');
            $(o).parent().children('span:eq(0)').html('确定');
            $(o).parent().children('span:eq(0)').attr('onclick', 'qtdy(this)');
            $(o).parent().children('span:eq(0)').css('background-color', 'rgba(19, 192, 238, 0.98)');
        } else {
            var fenpeiInputObj = $('<select name="teacher_id" onchange="savefenpei(this)"><option value="">选择老师：</option></select>');
            $(o).parent().parent().parent().children('td:eq(4)').append(fenpeiInputObj);
        }
        var selectObj = '';
        $.ajax({
            type: 'get',
            data: {sourseidd: p, classidd: q},
            url: "<?php echo U('search_teacher');?>",
            dataType: 'json',
            success: function (msg) {
                for (var i = 0; i < msg.length; i++) {
                    selectObj += "<option value='" + msg[i].id + "'>" + msg[i].teacher + "</option>";
                }
                $('select[name=teacher_id]').append(selectObj);
            }
        });
    }
    function quxc(o) {
        $(o).parent().parent().children('td:eq(4)').html(jiaoshi);
        $(o).html('修改');
        $(o).attr('onclick', onclickxqgljiaoshi);
        $(o).parent().children('span:eq(0)').html('分配教师');
        $(o).parent().children('span:eq(0)').attr('onclick', onclickfenpeijiaoshi);
        $(o).parent().children('span:eq(0)').css('background-color', '#e0e0e0');
    }
    //修改教师确定键
    function qtdy(o) {
        //被选择的value值;
        //教师id
        var a = $(o).parent().parent().children('td:eq(4)').children('select').children('option:selected').val();
        var valuess = $(o).parent().parent().children('td:eq(4)').children('select').children('option:selected').html();
        var b = $(o).parent().parent().children('input[name=sourseid]').val();
        var c = $(o).parent().parent().children('input[name=classid]').val();
        $.ajax({
            type: 'get',
            data: {teacher_idd: a, sourse_idd: b, class_idd: c},
            url: "<?php echo U('mod_fenpei');?>",
            dataType: 'json',
            success: function (msg) {
                if (msg > 0) {
                    $(o).parent().parent().children('td:eq(4)').html(valuess);
                    $(o).html('分配教师');
                    $(o).attr('onclick',onclickfenpeijiaoshi);
                    $(o).css('background-color','#e0e0e0');
                    $(o).parent().children('span:eq(1)').html('修改');
                    $(o).parent().children('span:eq(1)').attr('onclick',onclickxqgljiaoshi);
                }
            }
        });
    }
    //分配教师取消键
    function quxcfenpei(o) {
        $(o).parent().parent().children('td:eq(4)').html(jiaoshi);
        $(o).html('修改');
        $(o).attr('onclick', onclickxqgljiaoshi);
        $(o).parent().children('span:eq(0)').html('分配教师');
        $(o).parent().children('span:eq(0)').attr('onclick', onclickfenpeijiaoshi);
        $(o).parent().children('span:eq(0)').css('background-color', '#e0e0e0');
    }
    //分配教师确定键
    function qtdyfenpei(o) {
        //被选择的value值;
        //教师id
        var a = $(o).parent().parent().children('td:eq(4)').children('select').children('option:selected').val();
        var valuess = $(o).parent().parent().children('td:eq(4)').children('select').children('option:selected').html();
        var b = $(o).parent().parent().children('input[name=sourseid]').val();
        var c = $(o).parent().parent().children('input[name=classid]').val();
        $.ajax({
            type: 'get',
            data: {teacher_idd: a, sourse_idd: b, class_idd: c},
            url: "<?php echo U('save_fenpei');?>",
            dataType: 'json',
            success: function (msg) {
                if (msg > 0) {
                    $(o).parent().parent().children('td:eq(4)').html(valuess);
                    $(o).html('分配教师');
                    $(o).attr('onclick',onclickfenpeijiaoshi);
                    $(o).css('background-color','#e0e0e0');
                    $(o).parent().children('span:eq(1)').html('修改');
                    $(o).parent().children('span:eq(1)').attr('onclick',onclickxqgljiaoshi);
                }
            }
        });
    }
</script>