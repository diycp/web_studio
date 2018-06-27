<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\wamp64\www\Backstage\public/../application/admin\view\index\welcome.html";i:1530099454;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>欢迎页</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">

<div class="layui-row layui-col-space10 my-index-main">
    <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
        <div class="my-nav-btn layui-clear" data-href="./demo/btn.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe613;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text"><?php echo $member; ?></p>
                <p class="my-nav-text layui-elip">成员</p>
            </div>
        </div>
    </div>
    <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
        <div class="my-nav-btn layui-clear" data-href="./demo/tab-card.html">
            <div class="layui-col-md5">
                <button class="layui-btn layui-btn-big layui-btn-normal layui-icon">&#xe705;</button>
            </div>
            <div class="layui-col-md7 tc">
                <p class="my-nav-text"><?php echo $content; ?></p>
                <p class="my-nav-text layui-elip">文章</p>
            </div>
        </div>
    </div>
    <div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
        <div class="layui-col-xs6 layui-col-sm6 layui-col-md6">
            <fieldset class="layui-elem-field layui-field-title">
                <legend>公告</legend>
            </fieldset>
            <div class="layui-collapse" lay-accordion="">
            <?php foreach($data as $n): ?>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title"><?php echo $n['title']; ?></h2>
                    <div class="layui-colla-content">
                        <p><?php echo $n['content']; ?></p>
                    </div>
                </div>
               <?php endforeach; ?>
            </div>
        </div>
        <div class="layui-col-xs6 layui-col-sm6 layui-col-md6" style="padding-left: 10px">
            <fieldset class="layui-elem-field layui-field-title">
                <legend>版本</legend>
            </fieldset>
            <div class="layui-show">
                <ul class="layui-timeline max-auto">
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h3 class="layui-timeline-title">v1.8.0</h3>
                            <p>
                                更新日期:2017-08-26
                            </p>
                            <ul>
                                <li>更新layui-v1.0.9为layui-v2.0.2版本</li>
                                <li>右键增加关闭全部标签按钮</li>
                                <li>更新欢迎页面</li>
                                <li>更新data-table页面和tree-table页面为layui自带table组件</li>
                                <li>
                                    <h4>新增js功能</h4>
                                    <ul>
                                        <li>
                                            <p>vip_table.js</p>
                                            <ul>
                                                <li>getFullHeight方法  getFullHeight();    // 返回子页面整体高度,用于table组件设置全屏高度</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>修改已知BUG</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
<script type="text/javascript" src="__ADMIN__/js/index.js"></script>
<!-- <script type="text/javascript" src="../frame/echarts/echarts.min.js"></script> -->
<script type="text/javascript">
    layui.use(['element', 'form', 'table', 'layer'], function () {
        // var form = layui.form
                // , table = layui.table
                // , layer = layui.layer
                // , vipTab = layui.vip_tab
                // , $ = layui.jquery;
        // you code ...


    });
</script>
</body>
</html>