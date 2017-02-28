<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/Consumable/consumablApply" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="40%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e; font-size: 20px;">《<?php echo $sourse;?>》耗材工量具添加</td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">类别：</td>
                            <td class="teachAdd_right" width="200px">
                                <label><input type="radio" name="table" value="sx_consumable_temp" checked="checked"  style="width:8%;float:left;"><a style="float:left">耗材&nbsp;&nbsp;&nbsp;&nbsp;</a></label>
                                <label><input type="radio" name="table" value="sx_tool_temp" style="width:8%;float:left;"><a style="float:left;">工量具</a></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">名称：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="listname" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">单位：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="unit" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">推荐品牌：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="brand" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">推荐型号：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="version" value=""/>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="sct_id" value="<?php echo $sct_id;?>">
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
        history.go(-1);
    }
</script>