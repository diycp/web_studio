<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\wamp64\www\Backstage\public/../application/admin\view\member\addworks.html";i:1530100079;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>新增</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">作品添加</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" action="">
             <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>学号</label>
                    <div class="layui-input-block">
                        <input type="text" name="mid" value="<?php echo $Snumber; ?>"  disabled="display" lay-verify="required|number" auStocomplete="off"  class="layui-input" maxlength="11">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>作品标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="required" autocomplete="off" class="layui-input" maxlength="20">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片</label>
                    <div class="layui-input-block">
                    <button type="button" class="layui-btn" id="logo">上传图片</button>
                        <div class="layui-upload-list">
                        <input type="hidden" name="img" id="img" autocomplete="off" class="layui-input">
                        <img class="layui-upload-img" src="" width="120" height="80" style="display: none;" id="logo-effect">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">地址</label>
                    <div class="layui-input-block">
                       <input type="text" name="url" lay-verify="url" autocomplete="off" placeholder="填写自己的域名或github地址" class="layui-input" maxlength="30">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="描述一下作品。。。。" name="bese" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
<script>
    layui.use(['form', 'layedit', 'laydate','upload','jquery'], function(){
        var form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit,
                $ = layui.jquery,
                upload = layui.upload,
                laydate = layui.laydate; 
        
       //监听提交
        form.on('submit(demo1)', function(data){
            var index = parent.layer.getFrameIndex(window.name); 
            $.ajax({
                type: 'post',
                url: "<?php echo url('Member/addworks'); ?>",
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


        //上传图片
        upload.render({
            elem: '#logo'
            ,url: "<?php echo url('Uploads/upload'); ?>"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#logo-effect').attr('src', result);
                    $("#logo-effect").css('display','block'); 
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.status == 0){
                    $('#img').val(res.data);
                    layer.msg(res.msg, {
                      icon: 1,
                      time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    });
                } else {
                    layer.msg(res.msg,{icon: 5,time:1000});
                }
                //上传成功
            }
        });

    });
</script>
</body>
</html>