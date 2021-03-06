<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\wamp64\www\WEB-studio\Backstage\public/../application/admin\view\content\index.html";i:1530030613;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">

<div class="layui-row layui-col-space10">
    <div class="layui-col-xs12 layui-col-sm2 layui-col-md2">
        <!-- tree -->
        <ul id="tree" class="tree-table-tree-box"></ul>
    </div>
    <div class="layui-col-xs12 layui-col-sm10 layui-col-md10">
        <!-- 工具集 -->
        <fieldset class="layui-elem-field layui-field-title" style="display: none;" id="location">
            <legend id="location-text"></legend>
        </fieldset>
        <div class="my-btn-box" style="display: none;" id="tool">

            <span class="fl">
                <a class="layui-btn layui-btn-danger" id="btn-delete-all">批量删除</a>
                <a class="layui-btn btn-default btn-add" id="btn-add-article">发布文章</a>
            </span>
            
            <span class="fr">
                <span class="layui-form-label">搜索条件：</span>
                <div class="layui-input-inline">
                    <input type="text" id="condition" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
                </div>
                <button class="layui-btn mgl-20" id="search">查询</button>
            </span>
        </div>
        <!-- table -->
        <div id="dateTable" lay-filter="table"></div>
    </div>
</div>


<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
<script type="text/javascript" src="__ADMIN__/js/index.js"></script>
<script type="text/javascript" src="__ADMIN__/js/date.js"></script>
<script type="text/javascript" src="__ADMIN__/js/selected.js"></script>
<script type="text/javascript">
    // layui方法
    layui.use(['tree', 'table', 'vip_table', 'layer'], function () {
        // 操作对象
        var table = layui.table,
                vipTable = layui.vip_table,
                layer = layui.layer,
                $ = layui.jquery;
        var nodes,tableIns,cid;
        console.log(cid);
        

        // 获取选中行
        table.on('checkbox(dataCheck)', function (obj) {
            console.log(obj.checked); //当前是否选中状态
            console.log(obj.data); //选中行的相关数据
            console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
        });

        //获取分类
        $.ajax({
            type: 'post',
            url: "<?php echo url('Category/getCategory'); ?>",
            async:false,
            dataType: 'json',
            success: function(data){
                nodes = data.data;
            },
            error:function(data) {
                layer.msg('提交失败!',{icon: 5,time:1000});
            },
        });
        // 树
        layui.tree({
            elem: '#tree', //传入元素选择器
            click: function (item) { //点击节点回调
                cid = item.id;
                $('#location-text').html(" 所在栏目：" + item.name);
                $('#location').css('display','block');
                $('#tool').css('display','block');
                // 加载中...
                var loadIndex = layer.load(2, {shade: false});
                // 关闭加载
                layer.close(loadIndex);
                // 刷新表格
                // 表格渲染
                tableIns = table.render({
                    elem: '#dateTable',                  //指定原始表格元素选择器（推荐id选择器）
                    height: vipTable.getFullHeight() - 80,    //容器高度
                    id: 'dataCheck',
                    url: "<?php echo url('Content/getContent'); ?>",
                    method: 'get',
                    page: true,
                    limits: [30, 60, 90, 150, 300],
                    limit: 2, //默认采用30
                    loading: false,
                    cols: [[                  //标题栏
                        {checkbox: true, sort: true, fixed: true, space: true},
                        {field: 'id', title: 'ID', width: 80},
                        {field: 'title', title: '标题', width: 300},
                        {field: 'name', title: '发布者', width: 200},
                        {field: 'time', title: '发布时间', width: 200, templet: '#timeTpl'},
                        {field: 'number', title: '点击量', width: 150},
                        {field: 'is_recommend', title: '是否推荐', width: 150,templet: '#recommendTpl'},
                        {fixed: 'right', title: '操作', width: 250, align: 'center', toolbar: '#barOption'} //这里的toolbar值是模板元素的选择器
                    ]],
                    where:{
                        cid: item.id
                    }
                });
            },
            nodes: nodes
        });

        //监听工具条
        table.on('tool(table)', function(obj){
            var data = obj.data;            //获得当前行数据
            var layEvent = obj.event;       //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr;                //获得当前行 tr 的DOM对象
            
            //编辑
            if(layEvent == 'edit'){
                // console.log(cid);
                layer.open({
                    type: 2,
                    title: '编辑文章',
                    shade: false,
                    maxmin: true,
                    area: ['95%', '95%'],
                    content: "<?php echo url('Content/editContent'); ?>?id="+data.id,
                    end: function(){
                        tableIns.reload('dataCheck', {})
                    }
                });
            }

            //删除
            if(layEvent === 'del'){ 
                layer.confirm('真的删除该栏目？', function(index){
                    $.ajax({
                        type: 'get',
                        url: "<?php echo url('Content/del'); ?>?id="+data.id,
                        dataType: 'json',
                        success: function(data){
                            if(data.status == 0){
                                layer.msg(data.msg, {
                                  icon: 1,
                                  time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                });
                                tableIns.reload();
                            } else {
                                layer.msg(data.msg,{icon: 5,time:1000});
                            }
                        },
                        error:function(data) {
                            layer.msg('删除失败!',{icon: 5,time:1000});
                        },
                    }); 
                });
            }
        });

        //添加
        $('#btn-add-article').on('click', function () {
            layer.open({
                type: 2,
                title: '发布文章',
                shade: false,
                maxmin: true,
                area: ['95%', '95%'],
                content: "<?php echo url('Content/addContent'); ?>?cid="+cid,
                end: function(){
                    tableIns.reload('dataCheck', {})
                }
            });
        });

        // 监听多选删除按钮
        $('#btn-delete-all').on('click',function(){
            var checkStatus = table.checkStatus('dataCheck'); // table-id-2 即为基础参数id对应的值
            if(!checkStatus.data.length){
                layer.msg('未选中数据');
                return false;
            }
            var ids = getSelectedsId(checkStatus.data);
            layer.confirm('真的批量删除用户？', function(index){
                $.ajax({
                    type: 'post',
                    url: "<?php echo url('Content/batchDel'); ?>",
                    data:{
                        'id':ids
                    },
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 0){
                            layer.msg(data.msg, {
                              icon: 1,
                              time: 1000 //2秒关闭（如果不配置，默认是3秒）
                            });
                            tableIns.reload();
                        } else {
                            layer.msg(data.msg,{icon: 5,time:1000});
                        }
                    },
                    error:function(data) {
                        layer.msg('批量删除失败',{icon: 5,time:1000});
                    },
                }); 
            });
        });

        //获取选中的ID
        function checkId(data){
            var ids;
            if(data){
                for (var i = 0; i < data.length; i++) {
                    if(i == 0){
                        ids = data[i].id;
                    } else {
                        ids = ids+','+data[i].id;
                    }
                }
            }
            return ids;
        }

        //搜索
        $('#search').on('click', function () {
            tableIns.reload({
                where: {
                    cid: cid,
                    condition: $('#condition').val()
                }
            });
        });

    });
</script>
<script type="text/html" id="timeTpl">
  {{ timestampToTime(d.time) }} 
</script>
<script type="text/html" id="recommendTpl">
  {{#  if(d.is_recommend == 1){ }}
    <span class="layui-btn layui-btn-mini layui-btn-danger layui-btn-radius">推荐</span>

  {{#  } }}
</script>
<!-- 表格操作按钮集 -->
<script type="text/html" id="barOption">
    <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-mini layui-btn-danger" lay-event="del">删除</a>
</script>
</body>
</html>