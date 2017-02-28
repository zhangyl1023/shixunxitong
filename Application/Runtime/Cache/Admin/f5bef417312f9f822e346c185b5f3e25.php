<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd"><h2>编辑课程</h2>
                <form action="/Admin/Sourse/modSourse" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="60%" class="table teachAdd">
                        <?php foreach($data as $v){ ?>
                        <tr>
                            <td class="teachAdd_left">专业:</td>
                            <td class="teachAdd_right4">
                                <select name="profession_id">
                                    <option value="">请选择：</option>
                                    <?php foreach($dataa as $vv){ ?>
                                    <option value="<?php echo $vv['id'];?>" <?php if($vv['id']==$v['profession_id']){echo 'selected="selected"';};?>><?php echo $vv['profession'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">学期:</td>
                            <td class="teachAdd_right4">
                                <select name="semester_id">
                                    <option value="">请选择：</option>
                                    <?php foreach($dataaa as $vvv){ ?>
                                    <option value="<?php echo $vvv['id'];?>" <?php if($vvv['id']==$v['semester_id']){echo 'selected="selected"';};?>><?php echo $vvv['semester'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">课程：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="sourse" id="" value="<?php echo $v['sourse'];?>"/>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <span class="table_clear" onclick="table_submit()">提交</span>
                    <span class="table_submit" onclick="back()">返回</span>
                    <input type="hidden" name="id" value="<?php echo $v['id'];?>">
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
        window.location.href="<?php echo U('showSourse');?>";
    }
</script>