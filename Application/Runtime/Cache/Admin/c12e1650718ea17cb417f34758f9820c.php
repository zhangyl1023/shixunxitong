<?php if (!defined('THINK_PATH')) exit(); include_once '/Public/head.html'; ?>
<div class="content">
    <div class="content_head"></div>
    <!--<div class="content_slide"></div>-->
    <section id="content_slide">
        <div class="box">
            <div class="div_table div_tableAdd">
                <form action="/Admin/Role/addRole" enctype="multipart/form-data" method="post" name="theForm">
                    <table width="40%" class="table teachAdd">
                        <tr>
                            <td class="teachAdd_left" colspan="2" style="color: #ff661e; font-size: 20px;">角色添加</td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">角色名称:</td>
                            <td class="teachAdd_right">
                                <input type="text" name="role_name" id="" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td class="teachAdd_left">权限列表:</td>
                            <td class="teachAdd_right4" style="text-align: left;">
                                <?php foreach($data as $v){ ?>
                                <input type="checkbox" name="priv_id[]" value="<?php echo $v['id'];?>">
                                <a <?php if($v['lev']==0){echo "style='color:#4675FF;'";}else if($v['lev']==1){echo "style='color:#FFAE1B;'";}?>
                                >
                                <?php echo str_repeat('--',$v['lev']).$v['priv_name'].'<br>';?>
                                </a>
                                <?php } ?>
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