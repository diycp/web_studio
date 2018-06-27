<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"C:\var\www\WEB-studio\Backstage\public/../application/admin\view\index\welcome.html";i:1529854800;}*/ ?>
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
                <p class="my-nav-text">40</p>
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
                <p class="my-nav-text">40</p>
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
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">layui 更适合哪些开发者？</h2>
                    <div class="layui-colla-content">
                        <p>在前端技术快速变革的今天，layui 仍然坚持语义化的组织模式，甚至于模块理念都是采用类AMD组织形式，并非是有意与时代背道而驰。layui
                            认为以jQuery为核心的开发方式还没有到完全消亡的时候，而早期市面上基于jQuery的UI都普通做得差强人意，所以需要有一个新的UI去重新为这一领域注入活力，并采用一些更科学的架构方式。
                            <br>
                            因此准确地说，layui 更多是面向那些追求开发简单的前端工程师们，以及所有层次的服务端程序员。</p>
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">为什么JS社区大量采用未发布或者未广泛支持的语言特性？</h2>
                    <div class="layui-colla-content">
                        <p>
                            有不少其他答案说是因为JS太差。我下面的答案已经说了，这不是根本性的原因。但除此之外，我还要纠正一些对JS具体问题的误解。JS当初是被作为脚本语言设计的，所以某些问题并不是JS设计得差或者是JS设计者的失误。比如var的作用域问题，并不是“错误”，而是当时绝大部分脚本语言都是这样的，如perl/php/sh等。模块的问题也是，脚本语言几乎都没有模块/命名空间功能。弱类型、for-in之类的问题也是，只不过现在用那些老的脚本语言的人比较少，所以很多人都误以为是JS才有的坑。另外有人说JS是半残语言，满足不了开发需求，1999年就该死。半残这个嘛，就夸张了。JS虽然有很多问题，但是设计总体还是优秀的。——来自知乎@贺师俊</p>
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">为什么前端工程师多不愿意用 Bootstrap 框架？</h2>
                    <div class="layui-colla-content">
                        <p>
                            因为不适合。如果希望开发长期的项目或者制作产品类网站，那么就需要实现特定的设计，为了在维护项目中可以方便地按设计师要求快速修改样式，肯定会逐步编写出各种业务组件、工具类，相当于为项目自行开发一套框架。——来自知乎@Kayo</p>
                    </div>
                </div>
                <div class="layui-colla-item">
                    <h2 class="layui-colla-title">贤心是男是女？</h2>
                    <div class="layui-colla-content">
                        <p>man！ 所以这个问题不要再出现了。。。</p>
                    </div>
                </div>
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