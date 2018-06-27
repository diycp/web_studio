<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\wamp64\www\Backstage\public/../application/admin\view\member\showmember.html";i:1530014185;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>成员信息</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this"><?php echo $data['name']; ?></li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form" action="">
             <div class="layui-form-item">
                    <label class="layui-form-label">学号</label>
                    <div class="layui-input-block">
                       <?php echo $data['Snumber']; ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">姓名</label>
                    <div class="layui-input-block">
                        <?php echo $data['name']; ?>
                    </div>
                </div>
               <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <?php echo $data['sex']; ?>
                       </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">班级</label>
                    <div class="layui-input-block">
                         <?php echo $data['class']; ?>
                    </div>
                </div>
                
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">联系电话</label>
                    <div class="layui-input-block">
                       <?php echo $data['phone']; ?>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">微信号</label>
                    <div class="layui-input-block">
                       <?php echo $data['wechat']; ?>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">个人简介</label>
                    <div class="layui-input-block">
                        <?php echo $data['info']; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
</body>
</html>