<div class="layui-card">
    <div class="layui-card-header header-title">号码列表</div>
    <div class="layui-card-body layui-form">
        <div class="layui-inline">
        <input type="text" class="layui-input js_search_title" placeholder="输入手机号码搜索">
        </div>
       <!-- <div class="layui-inline">
            <select id="select-sort-search">
                <option  value="">请选择排序</option>
                <option  value="1">倒序</option>
                <option  value="2">正序</option>
            </select>
        </div>-->
        <button type="button" id="search_btn" class="layui-btn layui-btn-normal">搜索</button>
    </div>
    <div class="layui-card-body">
        <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>

       <script type="text/html" id="test-table-toolbar-toolbarDemo">
            <div class="layui-btn-container">
                <a href="/number-list/info" class="layui-btn layui-btn-sm">添加组件</a>
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
            ,url: '/number-list/index'
            ,id : 'reloaded'
            ,cols: [[
                {field:'id', width:80, title: 'ID', sort: true}
                ,{field:'tel',title: '手机号'}
                ,{field:'createtime',  title: '创建时间'}
                ,{field:'is_recommend',width:100, title: '是否推荐',templet: '#switchTpl'}
                ,{field:'online', title: '网络类型',templet:function(d){
                        if(d.online == 1){
                            return '中国移动';
                        }else if(d.online == 2){
                            return '中国联通';
                        }else if(d.online == 3){
                            return '中国电信'
                        }
                    }}
                ,{field:'address', title: '归属地'}
                ,{field:'content', title: '套餐'}
                ,{ title:'操作', toolbar: '#test-table-toolbar-barDemo', width:120}
            ]]
            ,done:function(res){
            }
            ,page: true
            ,limit: 50
        });


        // 推荐单选开关事件
        form.on('switch(filter-recommend)',function(res){
            $.post('/number-list/recommend',{is_recommend:(res.elem.checked ? 1 : 0),id:res.value},function(data){
                layer.tips(data.message, $(res.elem).next(), {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            },'json')
        })


        //监听行工具事件
        table.on('tool(test-table-toolbar)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('您确定要删除吗', function(index){
                    obj.del();
                    layer.close(index);
                    $.post('/widget/delete',{id:data.id},function(res){
                        if(res.code == 100000){
                            layer.msg(res.message);
                        }
                    },'json')
                });
            } else if(obj.event === 'edit'){
                window.location.href = '/number-list/info/?id='+data.id;
            }
        });

        //搜索
        $('#search_btn').bind('click',function(){
            var title = $('.js_search_title').val();
                //执行重载
                table.reload('reloaded', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    , where: {
                        tel: title,
                    }
                });
        });
    });
</script>