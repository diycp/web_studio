<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\var\www\WEB-studio\Backstage\public/../application/admin\view\member\index.html";i:1529936875;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Data-Table 表格</title>
    <link rel="stylesheet" href="__ADMIN__/frame/layui/css/layui.css">
    <!--<link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="__ADMIN__/frame/static/css/style.css">
    <link rel="icon" href="__ADMIN__/frame/static/image/code.png">
</head>
<body class="body">

<!-- 工具集 -->
<div class="my-btn-box">
    <span class="fl">
        <a class="layui-btn layui-btn-danger radius btn-delect" id="btn-delete-all">批量删除</a>
        <a class="layui-btn btn-add btn-default" id="btn-add">添加</a>
        <a class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i></a>
    </span>
    <span class="fr">
        <span class="layui-form-label">搜索条件：</span>
        <div class="layui-input-inline">
            <input type="text" id="condition" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
        </div>
        <button class="layui-btn mgl-20" id="search">查询</button>
    </span>
</div>

<!-- 表格 -->
<div id="dateTable" lay-filter="table"></div>

<script type="text/javascript" src="__ADMIN__/frame/layui/layui.js"></script>
<script type="text/javascript" src="__ADMIN__/js/index.js"></script>
<script type="text/javascript">

    // layui方法
    layui.use(['table', 'form', 'layer', 'vip_table'], function () {

        // 操作对象
        var form = layui.form
                , table = layui.table
                , layer = layui.layer
                , vipTable = layui.vip_table
                , $ = layui.jquery;

        // 表格渲染
        var tableIns = table.render({
            elem: '#dateTable',                  //指定原始表格元素选择器（推荐id选择器）
            height: vipTable.getFullHeight(),    //容器高度
            // cellMinWidth: 80,  
            id: 'dataCheck',
            url: '__ADMIN__/json/data_table.json',
            method: 'get',
            page: true,
            limits: [30, 60, 90, 150, 300],
            limit: 30, //默认采用30
            loading: false,
            cols: [[                  //标题栏
                {checkbox: true, sort: true, fixed: true, space: true},
                {field: 'id', title: 'ID',width:100},
                {field: 'username', title: '姓名',width:100},
                {field: 'username', title: '性别',width:100},
                {field: 'username', title: '学号',width:100},
                {field: 'username', title: '班级',width:100},
                {field: 'username', title: '加入时间',width:100},
                {field: 'username', title: '联系电话',width:180},
                {field: 'username', title: '微信',width:180},
                {fixed: 'right', title: '操作',width:220, align: 'center', toolbar: '#barOption'} //这里的toolbar值是模板元素的选择器
            ]],
            done: function (res, curr, count) {
                //如果是异步请求数据方式，res即为你接口返回的信息。
                //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                console.log(res);

                //得到当前页码
                console.log(curr);

                //得到数据总量
                console.log(count);
            }
        });

        // 获取选中行
        table.on('checkbox(dataCheck)', function (obj) {
            layer.msg('123');
            console.log(obj.checked); //当前是否选中状态
            console.log(obj.data); //选中行的相关数据
            console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
        });

        // 刷新
        $('#btn-refresh').on('click', function () {
            tableIns.reload();
        });

        //添加
        $('#btn-add').on('click', function () {
            layer.open({
                type: 2,
                title: '新增',
                shade: false,
                maxmin: true,
                area: ['50%', '50%'],
                content: "<?php echo url(Member/addMember); ?>",
                end: function(){
                    table.reload('category-table', {})
                }
            });
        });

        //搜索
        $('#search').on('click', function () {
            layer.msg($('#condition').val());
        });

        // 监听多选删除按钮
        $('#btn-delete-all').on('click',function(){
            layer.msg(1111);
            var checkStatus = table.checkStatus('dataCheck'); // table-id-2 即为基础参数id对应的值
            if(!checkStatus.data.length){
                layer.msg('未选中数据');
                return false;
            }
            layer.msg(checkId(checkStatus.data));
        });

        //监听工具条
        table.on('tool(table)', function(obj){
            var data = obj.data;            //获得当前行数据
            var layEvent = obj.event;       //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr;                //获得当前行 tr 的DOM对象
            
            //查看
            if(layEvent == 'view'){
                layer.open({
                    type: 2,
                    title: '查看',
                    shade: false,
                    maxmin: true,
                    area: ['50%', '50%'],
                    content: "category-add.html"
                });
            }

            //编辑
            if(layEvent == 'edit'){
                layer.open({
                    type: 2,
                    title: '编辑',
                    shade: false,
                    maxmin: true,
                    area: ['50%', '50%'],
                    content: "category-add.html"
                });
            }

            //删除
            if(layEvent === 'del'){ 
                layer.confirm('真的删除该栏目？', function(index){
                    $.ajax({
                        type: 'get',
                        url: "",
                        dataType: 'json',
                        success: function(data){
                            if(data.status == 0){
                                obj.del();// 删除对应行（tr）的DOM结构
                                layer.close(index);
                                layer.msg(data.msg, {
                                  icon: 1,
                                  time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                });
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
    });
    
</script>
<!-- 表格操作按钮集 -->
<script type="text/html" id="barOption">
    <a class="layui-btn layui-btn-mini layui-btn" lay-event="view">查看</a>
    <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-mini layui-btn-danger" lay-event="del">删除</a>
</script>
</body>
</html>