<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\wamp64\www\WEB-studio\Backstage\public/../application/admin\view\index\editpassword.html";i:1530004159;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>WEB前端开发工作室-后台管理系统</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>修改密码</legend>
</fieldset>

<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo $username; ?>" readonly="readonly" lay-verify="required" autocomplete="off" placeholder="请输入用户名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">原密码</label>
        <div class="layui-input-block">
            <input type="password" name="oldPassword" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">新密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" id="password" lay-verify="required|pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">确认密码</label>
        <div class="layui-input-block">
            <input type="password" name="confirmPassword" lay-verify="required|repass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>

<script src="__ADMIN__/frame/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form', 'layedit', 'laydate','jquery'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,$ = layui.jquery
                ,layedit = layui.layedit
                ,laydate = layui.laydate;

        //验证
        form.verify({
            pass: function(value,item){
                var reg = /^[\S]{6,16}$/;
                if(!reg.test(value)){
                  return '密码必须6到16位，且不能出现空格';
                }
                if(/^\d+\d+\d$/.test(value)){
                  return '密码不能全为数字';
                }
            },
            repass: function (value) {
                if (value != $('#password').val()) {
                    return '密码不一致哦';
                }
            }
        });

        //监听提交
        form.on('submit(demo1)', function(data){
            $.ajax({
                type: 'post',
                url: "<?php echo url('Index/editPassword'); ?>",
                data: data.field,
                dataType: 'json',
                success: function(data){
                    console.log(data)
                    if(data.status == 0){
                        layer.msg(data.msg, {
                          icon: 1,
                          time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            $(window).attr('location',"<?php echo url('Login/login'); ?>");
                        });
                    } else {
                        layer.msg(data.msg,{icon: 5,time:1000});
                    }
                },
                error:function(data) {
                    layer.msg('更新失败!',{icon: 5,time:1000});
                },
            });
            return false;
        });


    });
</script>
</body>
</html>