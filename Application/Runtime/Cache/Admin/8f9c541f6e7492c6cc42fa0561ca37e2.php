<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table">
                <table width="60%" class="table teachPlan" id="geuu">
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
                        <!--<td class="teachPlan_8">操作</td>-->
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
                        <td class="teachPlan_7"
                            onclick="fenpeijiaoshi(this,<?php echo $v['sourseid']?>,<?php echo $v['classid'];?>)"><?php echo $v['teacher']?>
                        </td>
                        <!--<td class="teachPlan_8">-->
                        <!--<span class="teachPlan_ope" id="<?php echo $v['id']?>">-->
                        <!--<a href="<?php echo U('semestetPlan/modsemesterPlan',array('id'=>$v['id']));?>">编辑</a>-->
                        <!--</span>-->
                        <!--<span class="teachPlan_del" id="<?php echo $v['id']?>"-->
                        <!--onclick="del_table(this,<?php echo $v['id']?>)">删除-->
                        <!--</span>-->
                        <!--</td>-->
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
    //新建专业教学计划****************************************************************************************************
    function createProfessionPlan() {
        window.location.href = "<?php echo U('semesterPlan/addsemesterPlan');?>";
    }
    //END***************************************************************************************************************
    function fenpeijiaoshi(o, p, q) {
        var jiaoshi = $(o).html();
        jiaoshi=jiaoshi.replace(/(\s*$)/g, "");
        if ($(o).parent().parent().children().children().find('select').length > 0) {
            return false;
        }
        $(o).html("");
        if(jiaoshi.length>0){
            var fenpeiInputObj = $('<select name="teacher_id" onchange="modfenpei(this)"><option value="">选择老师：</option></select>');
            $(o).append(fenpeiInputObj);
        }else{
            var fenpeiInputObj = $('<select name="teacher_id" onchange="savefenpei(this)"><option value="">选择老师：</option></select>');
            $(o).append(fenpeiInputObj);
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

    function savefenpei(o) {
        //被选择的value值;
        //教师id
        var a = $(o).children('option:selected').val();
        var valuess = $(o).children('option:selected').html();

        var b = $(o).parent().parent().children('input[name=sourseid]').val();
        var c = $(o).parent().parent().children('input[name=classid]').val();
        $.ajax({
            type: 'get',
            data: {teacher_idd: a,sourse_idd: b, class_idd: c},
            url: "<?php echo U('save_fenpei');?>",
            dataType: 'json',
            success: function (msg) {
                if(msg>0){
                    $(o).parent().html(valuess);
                }
            }

        });
    }
    function modfenpei(o){
        //被选择的value值;
        //教师id
        var a = $(o).children('option:selected').val();
        var valuess = $(o).children('option:selected').html();

        var b = $(o).parent().parent().children('input[name=sourseid]').val();
        var c = $(o).parent().parent().children('input[name=classid]').val();
        $.ajax({
            type: 'get',
            data: {teacher_idd: a,sourse_idd: b, class_idd: c},
            url: "<?php echo U('mod_fenpei');?>",
            dataType: 'json',
            success: function (msg) {
                if(msg>0){
                    $(o).parent().html(valuess);
                }
            }

        });
    }

    //编辑表格***********************************************************************************************************
    var tdObj;
    var tdText;
    var inputObj;
    var tdTextfubf;
    function edit_table(o, id, field) {
        //获取当前单元格
        tdObj = $(o).parent().parent().children(':first');
        //如果td里面有input框在，则就return false;
        var inputgeuuObj = $(o).parent().parent().parent().children().children();
        var sdf = inputgeuuObj.find('input').length;
        if (sdf >= 1) {
            $('input').focus();
            return false;
        }
        //获取单元格里面的内容，
        tdText = tdObj.html();
        tdTextfubf = tdText;
        tdObj.html('');
        //创建一个input框， 添加到td里面
        inputObj = $("<input type='text' name='demo'/>");
        inputObj.css('font-size', '12px').css('border-width', 0);
        inputObj.val(tdText);
        inputObj.appendTo(tdObj);
        $("input[name=demo]").focus();
        $(o).html('确定').css('background-color', '#2015c0');
        $(o).parent().children(':last').html('取消').css('background-color', '#6e043c');
        $(o).attr('onclick', 'qtdyxxgl(this)');
        $(o).parent().children(':last').attr('onclick', 'quxcxxgl(this)');
    }
    //确定修改
    function qtdyxxgl(o) {
        //获取输入的值
        var valueObj = $('input[name=demo]').val();
        var valueId = $(o).attr('id');
        var temp;//临时id寄存处
        //执行ajax的请求
        $.ajax({
            type: 'get',
            data: {id: valueId, values: valueObj},
            url: '<?php echo U("edit_table")?>',
            success: function (msg) {
                if (msg > 0) {
//                    window.location.href = "<?php echo U('showSemester');?>";
                    tdObj.html(valueObj);
                    $(o).html('编辑').css('background-color', 'rgb(39,153,60)');
                    temp = $(o).attr('id');
                    $(o).attr('onclick', "edit_table(this," + temp + ",'semester')");
                    $(o).parent().children(':last').html('删除').css('background-color', 'rgb(215,82,83)');
                    temp = $(o).parent().children(':last').attr('id');
                    $(o).parent().children(":last").attr('onclick', "del_table(this," + temp + ")");
                } else {
                    alert('数据为空或未做修改');
                    $(o).parent().parent().children(":first").html(tdTextfubf);
                    $(o).html('编辑').css('background-color', 'rgb(39,153,60)');
                    temp = $(o).attr('id');
                    $(o).attr('onclick', "edit_table(this," + temp + ",'semester')");
                    $(o).parent().children(':last').html('删除').css('background-color', 'rgb(215,82,83)');
                    temp = $(o).parent().children(':last').attr('id');
                    $(o).parent().children(":last").attr('onclick', "del_table(this," + temp + ")");

                }
            }
        });
    }
    //取消修改
    function quxcxxgl(o) {
        $(tdObj).html(tdTextfubf);
        $(o).html('删除').css('background-color', 'rgb(215,82,83)');
        var temp = $(o).attr('id');
        $(o).attr('onclick', "del_table(this," + temp + ",'semester')");
        $(o).parent().children(':first').html('编辑').css('background-color', 'rgb(39,153,60)');
        var temp = $(o).parent().children(':first').attr('id');
        $(o).parent().children(":first").attr('onclick', "edit_table(this," + temp + ",'semester')");


    }

    //END***************************************************************************************************************

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