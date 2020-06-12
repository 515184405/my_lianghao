<div class="layui-card">
    <div class="layui-card-header header-title">案例列表</div>
    <div class="layui-card-body">
        <div class="layui-inline">
            <input type="text" class="layui-input js_search_title" placeholder="输入作品名搜索">
        </div>
        <button type="button" id="search_btn" class="layui-btn layui-btn-normal">搜索</button>
    </div>
    <div class="layui-card-body">
        <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>

        <script type="text/html" id="test-table-toolbar-toolbarDemo">
            <div class="layui-btn-container">
                <a href="/user/info" class="layui-btn layui-btn-sm">添加用户</a>
            </div>
        </script>

        <script type="text/html" id="switchTpl">
            <input type="checkbox" name="recommend" value="{{d.id}}" lay-skin="switch" lay-text="是|否" lay-filter="filter-recommend" {{ d.recommend == 1 ? 'checked' : '' }}>
        </script>

        <script type="text/html" id="test-table-toolbar-barDemo">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-xs" lay-event="edit">重置密码</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </div>
        </script>

    </div>
</div>
<script>
    var site_url = '<?=Yii::$app->params["backend_url"];?>';
    var site_url2 = '<?=Yii::$app->params["frontend_url"];?>';
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
            ,url: '/user/index'
            ,cols: [[
                {field:'id', width:80, title: 'ID', sort: true}
                ,{field:'username',title: '用户名'}
                ,{field:'created_time',  title: '创建时间',templet: function (d) {
                        return getLocalTime(d.created_time);
                    }}
                ,{field:'login_ip',title: '登录IP'}
                ,{ title:'操作', toolbar: '#test-table-toolbar-barDemo', width:150}
            ]]
            ,done:function(res){
                console.log(res);
            }
            ,page: true
            ,limit: 10
        });


        //监听行工具事件
        table.on('tool(test-table-toolbar)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('您确定要删除吗', function(index){
                    obj.del();
                    layer.close(index);
                    $.post('/user/delete',{id:data.id},function(res){
                        if(res.code == 100000){
                            layer.msg(res.message);
                        }
                    },'json')
                });
            }else if(obj.event === 'edit'){
                window.location.href = '/user/info/?id='+data.id;
            }
        });

        //搜索
        $('#search_btn').bind('click',function(){
            var title = $('.js_search_title').val();
            if(title){
                //执行重载
                table.reload('test-table-toolbar', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    , where: {
                        username: title
                    }
                });
            }
        })

        function getLocalTime(nS) {
            return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
        }

    });
</script>