<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"C:\var\www\WEB-studio\Backstage\public/../application/admin\view\setup\index.html";i:1529854800;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>选项卡</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">网站设置</li>
        <li>SEO设置</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入网站名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站logo</label>
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" id="logo">上传logo</button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" src="" width="120" height="80" style="display: none;" id="logo-effect">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站根网址</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入根网址" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站备案号</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入备案号" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">版权信息</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入版权信息" class="layui-textarea"></textarea>
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
        <div class="layui-tab-item">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">标题附加字</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题附加字" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站关键词</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入网站关键词" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入关键词描述" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </form>
        </div>
        <div class="layui-tab-item">内容3</div>
        <div class="layui-tab-item">内容4</div>
        <div class="layui-tab-item">内容5</div>
    </div>
</div>


<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['element','upload'], function () {
        var $ = layui.jquery
                , element = layui.element
                ,upload = layui.upload;
        //触发事件
        var active = {
            tabAdd: function () {
                //新增一个Tab项
                element.tabAdd('demo', {
                    title: '新选项' + (Math.random() * 1000 | 0) //用于演示
                    , content: '内容' + (Math.random() * 1000 | 0)
                })
            }
            , tabDelete: function () {
                //删除指定Tab项
                element.tabDelete('demo', 2); //删除第3项（注意序号是从0开始计算）
            }
            , tabChange: function () {
                //切换到指定Tab项
                element.tabChange('demo', 1); //切换到第2项（注意序号是从0开始计算）
            }
        };

        $('.site-demo-active').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        // you code ...
        //网站logo
        upload.render({
            elem: '#logo'
            ,url: '/upload/'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#logo-effect').attr('src', result);
                    $("#logo-effect").css('display','block'); 
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                //上传成功
            }
        });

    });
</script>

</body>
</html>