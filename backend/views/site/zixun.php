
<div class="layui-card">
    <div class="layui-card-header header-title">网站咨询</div>
    <div class="layui-card-body layui-form">

        <div class="layui-inline">
            <select id="select-status-search">
                <option  value="">请选择状态</option>
                <option  value="0">未联系</option>
                <option  value="1">已联系</option>
                <option  value="2">有意向</option>
                <option  value="3">已签约</option>
            </select>
        </div>
        <button type="button" id="search_btn" class="layui-btn layui-btn-normal">搜索</button>
    </div>
    <div class="layui-card-body">
        <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>

        <script type="text/html" id="test-table-toolbar-barDemo">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </div>
        </script>

    </div>
</div>

<script type="text/html" id="select-status-form">
    <div class="layui-form" style="padding:30px;">
        <select id="select-status" lay-filter="select-status" name="status" lay-verify="required">
            <option  value="0">未联系</option>
            <option  value="1">已联系</option>
            <option  value="2">有意向</option>
            <option  value="3">已签约</option>
        </select>
    </div>
</script>

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
            ,id:'reloaded'
            ,url: '/site/zixun'
            ,cols: [[
                {field:'id', width:80, title: 'ID', sort: true}
                ,{field:'name',title: '姓名'}
                ,{field:'tel',title: '手机号'}
                ,{field:'email',title: '邮箱'}
                ,{field:'content',title: '描述'}
                ,{field:'status',title: '状态',templet:function(d){
                        if(d.status == 0){
                            return '<span lay-event="change-status" class="">未联系</span>'
                        }
                        if(d.status == 1){
                            return '<span lay-event="change-status" class="theme-red">已联系</span>'
                        }
                        if(d.status == 2){
                            return '<span lay-event="change-status" class="theme">有意向</span>'
                        }
                        if(d.status == 3){
                            return '<span lay-event="change-status" style="color:#00dd00">已签约</span>'
                        }
                    }}
                 // ,{ title:'操作', toolbar: '#test-table-toolbar-barDemo', width:150}
            ]]
            ,done:function(res){
            }
            // ,page: true
            // ,limit: 10
        });

        //监听行工具事件
        table.on('tool(test-table-toolbar)', function(obj){
            var data = obj.data;
            if(obj.event === 'change-status') {
                layer.open({
                    type: 1,
                    title: '修改网站咨询状态',
                    area: ['400px', '300px'],
                    btn: ['确定'],
                    content: $('#select-status-form').html(),
                    success: function (layero, index) {
                        $(".layui-layer-page .layui-layer-content").css('overflow', 'visible');
                        $('#select-status option[value="' + data.status + '"]').attr('selected', 'selected');
                        form.render();
                    },
                    yes: function (index, layero) {
                        $.post('/site/info?id=' + data.id, {
                            status: $('#select-status option:selected').val()
                        }, function (data) {
                            layer.close(index);
                            table.reload('reloaded', {
                                page: {
                                    curr: $('.layui-laypage-curr em:last-child').text() //重新从第 1 页开始
                                }
                            });
                            layer.msg(data.message, {icon: 1, duration: 1500});
                        }, 'json')
                    }
                })
            }
        });

        //搜索
        $('#search_btn').bind('click',function(){
            var status = $('#select-status-search').val();
            //执行重载
            table.reload('reloaded', {
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                , where: {
                    status:status,
                }
            });
        });
        if('<?=isset($_GET["status"])?>'){
            $('#select-status-search').val('<?=isset($_GET["status"]) ? $_GET["status"] : ''?>');
            form.render();
            $('#search_btn').trigger('click');
        }
    });
</script>