<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\var\www\WEB-studio\Backstage\public/../application/admin\view\admin\addadmin.html";i:1529993101;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>表单</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>新增管理员</legend>
</fieldset>

<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-block">
            <input type="text" name="username" lay-verify="required|username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" lay-verify="required|pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否启用</label>
        <div class="layui-input-block">
            <input type="radio" name="switch" value="1" title="启用" checked="">
            <input type="radio" name="switch" value="0" title="禁用">
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
        var form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit,
                $ = layui.jquery,
                laydate = layui.laydate;
        //验证
        form.verify({
          username: function(value, item){
            if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
              return '用户名不能有特殊字符';
            }
            if(/(^\_)|(\__)|(\_+$)/.test(value)){
              return '用户名首尾不能出现下划线\'_\'';
            }
            if(/^\d+\d+\d$/.test(value)){
              return '用户名不能全为数字';
            }
          },
          pass: function(value,item){
            var reg = /^[\S]{6,16}$/;
            if(!reg.test(value)){
              return '密码必须6到16位，且不能出现空格';
            }
            if(/^\d+\d+\d$/.test(value)){
              return '密码不能全为数字';
            }
          }
        }); 

        //监听提交
        form.on('submit(demo1)', function(data){
            var index = parent.layer.getFrameIndex(window.name); 
            $.ajax({
                type: 'post',
                url: "<?php echo url('Admin/addAdmin'); ?>",
                data: data.field,
                dataType: 'json',
                success: function(data){
                    console.log(data)
                    if(data.status == 0){
                        layer.msg(data.msg, {
                          icon: 1,
                          time: 1000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                          parent.layer.close(index);
                        });
                    } else {
                        layer.msg(data.msg,{icon: 5,time:1000});
                    }
                },
                error:function(data) {
                    layer.msg('提交失败!',{icon: 5,time:1000});
                },
            });
            return false;
        });


    });
</script>
</body>
</html>