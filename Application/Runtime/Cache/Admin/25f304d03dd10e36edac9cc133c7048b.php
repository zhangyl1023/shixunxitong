<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd"><h2>添加权限</h2>
                <form action="/Admin/Privilege/addprivilege" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="60%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left">权限名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="priv_name" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">上级权限:</td>
                            <td class="teachAdd_right4">
                                <select name="parent_id">
                                    <option value="">请选择：</option>
                                    <?php foreach($data as $v){ ?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['Priv_name'];?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">对应模块名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="module_name" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">对应控制器名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="controller_name" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">对应方法名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="action_name" id="" value=""/>
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