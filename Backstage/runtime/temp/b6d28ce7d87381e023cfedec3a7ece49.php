<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"E:\wamp64\www\Backstage\public/../application/admin\view\category\editcategory.html";i:1530097752;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>新增栏目</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>新增栏目</legend>
</fieldset>

<form class="layui-form" action="">  
    <div class="layui-form-item">
        <label class="layui-form-label">所在栏目</label>
        <div class="layui-input-block">
         <?php if($data['pid'] == '0'): ?> 
         <input type="text" lay-verify="required" autocomplete="off" value="<?php echo $data['Lname']; ?>" class="layui-input" disabled="display">
          <?php else: ?>
            <select name="pid"  lay-filter="aihao">
                    <option value="<?php echo $Pid['id']; ?>"><?php echo $Pid['Lname']; ?></option>
                    <?php foreach($dataId as $p): ?>
                        <option value="<?php echo $p['id']; ?>"><?php echo $p['Lname']; ?></option> 
                     <?php endforeach; ?> 
                      <option value="0">转为顶级栏目</option>
            </select>
            <?php endif; ?>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">栏目名称</label>
        <div class="layui-input-block">
            <input type="text" name="Lname" lay-verify="required" autocomplete="off" value="<?php echo $data['Lname']; ?>" class="layui-input" maxlength="20">
        </div>
    </div>
     <div class="layui-form-item">
         <label class="layui-form-label">栏目图片</label>
              <div class="layui-input-block">
                    <button type="button" class="layui-btn" id="logo">上传图片</button>
                    <div class="layui-upload-list">
                     <input type="hidden" name="img" value="<?php echo $data['img']; ?>" id="img" autocomplete="off" class="layui-input">
               <?php if($data['img'] != '' || $data['img'] != null): ?>
                    <img class="layui-upload-img" src="<?php echo $data['img']; ?>" width="120" height="80" style="display: block;" id="logo-effect">
                <?php else: ?>
                    <img class="layui-upload-img" src="" width="120" height="80" style="display: none;" id="logo-effect">
                <?php endif; ?>
            </div>
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">跳转模块</label>
        <div class="layui-input-block">
            <input type="text" name="module" lay-verify="required" autocomplete="off" value="<?php echo $data['module']; ?>" class="layui-input" maxlength="30">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">栏目描述</label>
        <div class="layui-input-block">
            <input type="text" name="desc" lay-verify="required" autocomplete="off" value="<?php echo $data['desc']; ?>" class="layui-input" maxlength="40">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">栏目位置</label>
        <div class="layui-input-block">
         <?php if($data['type'] == 'top'): ?> 
                <input type="radio" name="type" value="top" title="顶部" checked>
                 <input type="radio" name="type" value="bottom" title="底部">
                <?php else: ?>
                 <input type="radio" name="type" value="top" title="顶部" >
                <input type="radio" name="type" value="bottom" title="底部" checked>
            <?php endif; ?>
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
    layui.use(['form', 'layedit', 'laydate','upload','jquery'], function(){
        var form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit,
                $ = layui.jquery,
                upload = layui.upload,
                laydate = layui.laydate; 
        //监听提交
       //监听提交
        form.on('submit(demo1)', function(data){
            var index = parent.layer.getFrameIndex(window.name); 
            $.ajax({
                type: 'post',
                url: "<?php echo url('Category/editCategory'); ?>?id=<?php echo $data['id']; ?>",
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

        //上传栏目图片
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