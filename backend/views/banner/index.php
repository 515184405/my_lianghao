
<div class="layui-card">
    <div class="layui-card-header header-title">轮播列表</div>
    <div class="layui-card-body">
        <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>

        <script type="text/html" id="test-table-toolbar-toolbarDemo">
            <div class="layui-btn-container">
                <a href="/banner/info" class="layui-btn layui-btn-sm">添加banner</a>
            </div>
        </script>

        <script type="text/html" id="test-table-toolbar-barDemo">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </div>
        </script>

    </div>
</div>
<script>
    var site_url = '<?=Yii::$app->params["backend_url"];?>';
    var frontend_url = '<?=Yii::$app->params["frontend_url"];?>';
    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'table','form'], function(){
        var $ = layui.$,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#test-table-toolbar'
            ,toolbar: '#test-table-toolbar-toolbarDemo'
            ,url: '/banner/index'
            ,cols: [[
                {field:'id', width:80, title: 'ID', sort: true}
                ,{field:'desc',title: '描述'}
                ,{field:'url',title: '链接',templet:function(d){
                        return '<a class="theme" target="_blank" href='+d.url+' >'+d.url+'</a>';
                    }}
                ,{field:'sort',width:100, title: '排序',edit:'text'}
                ,{field:'imgsrc', title: '列表图',templet: function (d) {
                        return '<a class="theme js_banner_url" target="_blank" href='+site_url+d.imgsrc+' >'+d.imgsrc+'</a>';
                  }}
                ,{ title:'操作', toolbar: '#test-table-toolbar-barDemo', width:150}
            ]]
            ,done:function(res){
                console.log(res);
            }
            // ,page: true
            // ,limit: 10
        });

        //小图tip
        $(document).delegate('.js_banner_url','mouseenter',function(){
            var img = new Image();
            var that = this;
            img.onload = function(){
                layer.tips('<img style="width:180px;" src="'+$(that).attr('href')+'" />', that, {
                    tips: [3,'#5181a1'],
                    time:9999999
                });
            }
            img.src = $(this).attr('href');
        });
        $(document).delegate('.js_banner_url','mouseleave',function(){
            layer.closeAll('tips');
        });

        //监听单元格编辑
        table.on('edit(test-table-toolbar)', function(obj){
            var value = obj.value //得到修改后的值
                ,data = obj.data //得到所在行所有键值
                ,field = obj.field; //得到字段
            $.post('/banner/sort',{sort:value,id:data.id},function(res){
                if(res.code == 100000){
                    layer.msg(res.message,{icon:1});
                }else{
                    layer.msg(res.message,{icon:5});
                }
            },'json')
        });

        //监听行工具事件
        table.on('tool(test-table-toolbar)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('您确定要删除吗', function(index){
                    obj.del();
                    layer.close(index);
                    $.post('/banner/delete',{id:data.id},function(res){
                        if(res.code == 100000){
                            layer.msg(res.message);
                        }
                    },'json')
                });
            } else if(obj.event === 'edit'){
                window.location.href = '/banner/info/?id='+data.id;
            }
        });
    });
</script>