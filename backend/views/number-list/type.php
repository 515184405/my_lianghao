<div class="layui-card">
    <div class="layui-card-header header-title">添加文章类型</div>
    <div class="layui-card-body">
        <form class="layui-form" >
            <div class="layui-form-item">
                <label class="layui-form-label">类型名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="submit-btn">立即提交</button>
                    <a href="/case" class="layui-btn layui-btn-primary">返回列表</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','form'], function() {
        var $ = layui.$,
            form = layui.form;
        form.on('submit(submit-btn)', function(data){
            layer.load(1, {shade: .1});
            var _this = this;_this.disabled=true;//防止多次提交
            var params = data.field;

            $.ajax({
                type: "post",
                url: "",
                data: params,
                dataType: "json",
                success: function(res) {
                    layer.closeAll();
                    if(res.code == '100000'){
                        layer.confirm(res.message+'是否继续添加？', {
                            btn: ['确定','取消'] //按钮
                        }, function(){
                            layer.closeAll();
                            window.location.reload();
                        }, function(){
                            location.href='/news';
                        });
                    }else{
                        layer.msg(res.message, {icon: 1}, function(){
                            window.location.reload();
                        })
                    }

                },
                error: function(){
                    layer.closeAll();
                    _this.disabled=false;
                    layer.msg('操作失败', {icon: 1}, function(){
                        //window.location.reload();
                    })
                }
            });

            return false;
        });
    })
</script>