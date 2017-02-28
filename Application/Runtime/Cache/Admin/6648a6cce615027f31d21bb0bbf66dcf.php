<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/Class/addClass" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="30%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e; font-size: 20px;">添加专业班级</td>
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
                            <td class="teachAdd_left">班级：</td>
                            <td class="teachAdd_right">
                                <input type="text" name="class" id="" value=""/>
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
        window.location.href="<?php echo U('showClass');?>";
    }
</script>