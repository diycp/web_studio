<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\wamp64\www\WEB-studio\Backstage\public/../application/admin\view\content\editcontent.html";i:1530029114;}*/ ?>
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
    <legend>发布文章</legend>
</fieldset>

<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo $data['title']; ?>"  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入描述" name="desc" class="layui-textarea"><?php echo $data['desc']; ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>发布者</label>
        <div class="layui-input-block">
            <input type="text" name="name" value="<?php echo $data['name']; ?>" lay-verify="required" placeholder="发布者" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">缩略图</label>
        <div class="layui-input-block">
            <button type="button" class="layui-btn" id="logo">上传缩略图</button>
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
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>内容</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="LAY_demo_editor"><?php echo $data['content']; ?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color: red;font-weight: bold;">*</span>排序</label>
        <div class="layui-input-block">
            <input type="text" name="sid" value="<?php echo $data['sid']; ?>"lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否推荐</label>
        <div class="layui-input-block">
            <input type="radio" name="is_recommend" value="0" title="否" <?php if($data['is_recommend'] == '0'): ?>checked<?php endif; ?>>
            <input type="radio" name="is_recommend" value="1" title="是" <?php if($data['is_recommend'] == '1'): ?>checked<?php endif; ?>>
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
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate
                ,$ = layui.jquery
                ,upload = layui.upload;

        layedit.set({
            height: 700,
            uploadImage: {
                url: "<?php echo url('Content/editorUpload'); ?>", //接口url
                type: 'post' //默认post
            }
        });
    
        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //验证
        form.verify({
          content: function(value,item){
            
            if(layedit.getContent(editIndex) == "" || layedit.getContent(editIndex) == null){
              return '必填项不能为空';
            }
          }
        });

        //监听提交
        form.on('submit(demo1)', function(data){
            var index = parent.layer.getFrameIndex(window.name); 
            $.ajax({
                type: 'post',
                url: "<?php echo url('Content/editContent'); ?>?id=<?php echo $id; ?>",
                data: {
                    title: data.field.title,
                    desc: data.field.desc,
                    name: data.field.name,
                    img: data.field.img,
                    content: layedit.getContent(editIndex),
                    sid: data.field.sid,
                    is_recommend: data.field.is_recommend,
                },
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

        //网站logo
        upload.render({
            elem: '#logo'
            ,url: "<?php echo url('Content/thumbnailUpload'); ?>"
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
                    layer.msg(data.msg, {
                      icon: 1,
                      time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    });
                } else {
                    layer.msg(data.msg,{icon: 5,time:1000});
                }
                //上传成功
            }
        });


    });
</script>
</body>
</html>