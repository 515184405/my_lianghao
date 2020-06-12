
<div class="layui-card">
    <div class="layui-card-header header-title">筛选规则列表</div>
    <div class="layui-card-body">
        <div class="fy-more-row-td">
            <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>
        </div>
        <script type="text/html" id="test-table-toolbar-toolbarDemo">
            <div class="layui-btn-container">
                <a href="/nav/info" class="layui-btn layui-btn-sm">设置筛选规则</a>
            </div>
        </script>

        <script type="text/html" id="switchTpl">
            <input type="checkbox" name="recommend" value="{{d.id}}" lay-skin="switch" lay-text="是|否" lay-filter="filter-recommend" {{ d.is_recommend == 1 ? 'checked' : '' }}>
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
            ,url: '/nav/index'
            ,cols: [[
                {field:'id', width:80, title: 'ID', sort: true}
                ,{field:'name',title: '描述'}
                ,{field:'url',title: '筛选条件'}
                ,{field:'is_recommend', title: '设为首页快捷方式',templet: '#switchTpl'}
                ,{field:'sort',width:100, title: '排序',edit:'text'}
                ,{field:'imgsrc', title: '列表图',templet: function (d) {
                    if(d.imgsrc){
                        return '<img style="width:30px" src="'+site_url+d.imgsrc+'"/>';
                    }else{
                        return '未上传';
                    }
                  }}
                ,{ title:'操作', toolbar: '#test-table-toolbar-barDemo', width:150}
            ]]
            ,done:function(res){
                console.log(res);
            }
            // ,page: true
            // ,limit: 10
        });

        // 推荐单选开关事件
        form.on('switch(filter-recommend)',function(res){
            $.post('/nav/recommend',{is_recommend:(res.elem.checked ? 1 : 0),id:res.value},function(data){
                layer.tips(data.message, $(res.elem).next(), {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            },'json')
        })

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
            $.post('/nav/sort',{sort:value,id:data.id},function(res){
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
                    $.post('/nav/delete',{id:data.id},function(res){
                        if(res.code == 100000){
                            layer.msg(res.message);
                        }
                    },'json')
                });
            } else if(obj.event === 'edit'){
                window.location.href = '/nav/info/?id='+data.id;
            }
        });
    });
</script>