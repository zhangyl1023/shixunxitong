<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/SourseItem/addSourseItem" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="60%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e;">新建实训课程项目</td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">课程：</td>
                            <td class="teachAdd_right" width="200px">
                                <select name="sct_id" onchange="searchsourse(this)">
                                    <option value="">请选择：</option>
                                    <?php foreach($data as $v){ ?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['profession'];echo $v['class'].'班'.'--';echo $v['sourse'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">项目：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="itemname" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">内容：</td>
                            <td class="teachAdd_right">
                                <textarea name="content" id="" cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">教师：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="teacher" value="王五" disabled="disabled">
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left"><a href="javascript:" onclick="clonethis(this)">[+]</a>耗材：</td>
                            <td class="teachAdd_right">
                                <select name="consumable_list[]" id="consumable" onchange="displayunit(this)" style="float:left;">
                                    <option value="">请先选择课程：</option>
                                </select>
                                <div style="float:left;">数量:</div>
                                <input type="text" name="numb[]" style="width:20%;float: left;">
                                <a style="float:left;"></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left"><a href="javascript:" onclick="clonethistool(this)">[+]</a>工量具：</td>
                            <td class="teachAdd_right">
                                <select name="tool_list[]" id="tool" onchange="displaytoolunit(this)" style="float:left;">
                                    <option value="">请先选择课程：</option>
                                </select>
                                <div style="float:left;">数量:</div>
                                <input type="text" name="tool_numb[]" style="width:20%;	float: left;">
                                <a style="float:left;"></a>
                            </td>
                        </tr>
                    </table>
                    <!--<input type="hidden" name="sct_id" value="<?php echo $sct_id;?>">-->
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
    //定义一个计数器
    var ii=1;
    var jj=1;
    function searchsourse(o) {
        var sct_id = $(o).children('option:selected').val();
        $('select[name^=consumable_list]').children().remove();
        $('select[name^=tool_list]').children().remove();
        var optionObj = '';
        var optionObjjj='';
        var i;
        var k=0;
        $.ajax({
            type: 'get',
            url: "<?php echo U('searchsourse');?>",
            data: {sct_id: sct_id},
            success: function (msg) {
                //将msg拆分成两个表
                var msgc=[];var msgt=[];
                for(i=0;i<msg.length;i++){
                    if(msg[i].table=='sx_consumable_list'){
                        msgc[i]=msg[i];
                    }
                }
                for(var l=0;l<msg.length;l++){
                    if(msg[l].table=='sx_tool_list'){
                        msgt[k]=msg[l];
                        k++;
                    }
                }
                //拆分end
                //给第一个输入框加入选项
                if (msgc.length == 0) {
                    var optionObjj = "<option value=''>无可选耗材</option>";
                    $('select[name^=consumable_list]').append(optionObjj);
                }else{
                    optionObj += "<option value=''>" + msgc.length + "个可选项：</option>";
                    for (var h = 0; h < msgc.length; h++) {
                        optionObj += "<option value='" + msgc[h].idd + "'>" + msgc[h].listname + "</option>";
                    }
                    $('select[name^=consumable_list]').append(optionObj);
                }
                //给第二个输入框加入选项
                if (msgt.length == 0) {
                    var optionObjjjj = "<option value=''>无可选耗材</option>";
                    $('select[name^=tool_list]').append(optionObjjjj);
                }else{
                    optionObjjj += "<option value=''>" + msgt.length + "个可选项：</option>";
                    for (var j = 0; j < msgt.length; j++) {
                        optionObjjj += "<option value='" + msgt[j].idd + "'>" + msgt[j].listname + "</option>";
                    }
                    $('select[name^=tool_list]').append(optionObjjj);
                }
            }
        })
    }
    //第一个表的单位
    function displayunit(o) {
        $(o).parent().children('a').html("");
        var id = $(o).children('option:selected').val();
        $.ajax({
            type: 'get',
            url: "<?php echo U('displayunit');?>",
            data: {id: id},
            success: function (msg) {
                $(o).parent().children('a').append(msg[0].unit);
            }
        })
    }
    //第二个表的单位
    function displaytoolunit(o) {
        $(o).parent().children('a').html("");
        var id2 = $(o).children('option:selected').val();
        $.ajax({
            type: 'get',
            url: "<?php echo U('displayunittool');?>",
            data: {id: id2},
            success: function (msg) {
                $(o).parent().children('a').append(msg[0].unit);
            }
        })
    }
    function clonethis(o) {
        var curr_tr = $(o).parent().parent();
        if ($(o).html() == '[+]') {
            var new_tr = curr_tr.clone();
            new_tr.children(':first').find('a').html('[-]');
            curr_tr.after(new_tr);
        } else {
            curr_tr.remove();
        }
    }
    function displayunittool(o) {
        $(o).parent().children('a').html("");
        var id = $(o).children('option:selected').val();
        $.ajax({
            type: 'get',
            url: "<?php echo U('displayunit');?>",
            data: {id: id},
            success: function (msg) {
                $(o).parent().children('a').append(msg[0].unit);
            }
        })
    }
    //点击[+]克隆行
    function clonethistool(o) {
        var curr_tr = $(o).parent().parent();
        if ($(o).html() == '[+]') {
            var new_tr = curr_tr.clone();
            new_tr.children(':first').find('a').html('[-]');
            curr_tr.after(new_tr);
        } else {
            curr_tr.remove();
        }
    }
    function table_submit() {
        $('form').submit();
    }
    function back() {
        history.go(-1);
    }
</script>