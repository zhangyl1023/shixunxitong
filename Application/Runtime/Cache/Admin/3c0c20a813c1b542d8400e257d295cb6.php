<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/ProfessionPlan/addProfessionPlan" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="40%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e; font-size: 20px;">添加专业教学计划</td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">标题:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="title" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">作者:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="author" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">专业:</td>
                            <td class="teachAdd_right4">
                                <select name="profession_id">
                                    <option value="">请选择：</option>
                                    <?php foreach($data as $v){ ?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['profession'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">班级:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="class" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left teachAdd_left5">专业教学计划:</td>
                            <td class="teachAdd_right teachAdd_right5">
                                <textarea name="content" id="" cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                    </table>
                <span class="table_clear" onclick="table_submit()">提交</span>
                    <span class="table_submit" onclick="back()">返回</span>
                </form>
            </div>
        </div>
    </section>
</div>

<div class="clear"></div>

</body>
<script>
    function table_submit(){
        $('form').submit();
    }
    function back(){
        window.location.href="<?php echo U('showProfessionPlan');?>";
    }
    //新建专业教学计划****************************************************************************************************
    function createProfessionPlan() {
        window.location.href = "<?php echo U('professionPlan/addProfessionPlan');?>";
    }
    //END***************************************************************************************************************

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