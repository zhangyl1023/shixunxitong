<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/Returnres/modReturnres" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="60%" class="table teachAdd">
                        <?php foreach($data as $v){ ?>
                        <tr>
                            <td class="teachAdd_left" colspan="3"><h2>申请处理</h2></td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">名称：</td>
                            <td class="teachAdd_right" width="200px">
                                <input type="radio" name="table" value="sx_consumable_list" <?php if($suoshu=='sx_consumable_temp'){echo 'checked="checked"' ;};?> style="width:8%">耗材<input type="radio" name="table" value="sx_tool_list" style="width:8%" <?php if($suoshu=='sx_tool_temp'){echo 'checked="checked"' ;};?>>工量具
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">名称：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="listname" value="<?php echo $v['listname'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">初始库存：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="numb" value="0"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">单位：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="unit" value="<?php echo $v['unit'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">确认品牌：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="brand" value="<?php echo $v['brand'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">确认型号：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="version" value="<?php echo $v['version'];?>"/>
                            </td>
                        </tr>
                        <?php }?>
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
        history.go(-1);
    }
</script>