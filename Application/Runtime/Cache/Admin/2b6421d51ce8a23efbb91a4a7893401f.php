<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/Admin/addAdmin" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="40%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e; font-size: 20px;">管理员添加</td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">管理员名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="admin_name" maxlength="20" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">管理员密码:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="admin_password" maxlength="20" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">确认密码:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="rpassword" maxlength="20" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">所属角色:</td>
                            <td class="teachAdd_right4" style="text-align: left;">
                                <select name="role_id" id="">
                                    <option value="">选择角色</option>
                                    <?php foreach($data as $v){ ?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['role_name'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <span class="table_clear" onclick="$('form').submit()">提交</span>
                    <span class="table_submit" onclick="history.go(-1)">返回</span>
                </form>
            </div>
        </div>
    </section>
</div>

<div class="clear"></div>

</body>
<script>
</script>