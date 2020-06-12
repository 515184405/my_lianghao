<div class="layui-card">
    <div class="layui-card-header header-title">添加用户</div>
    <div class="layui-card-body">
        <form class="layui-form" >
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-block">
                    <input type="text" <?=isset($userInfo['username']) ? 'disabled style="background:#f1f0f0;"' : ''?> value="<?=isset($userInfo['username']) ? $userInfo['username'] : ''?>" name="username" lay-verify="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="text" name="password" lay-verify="password" autocomplete="off" placeholder="请输入密码" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="submit-btn">立即提交</button>
                    <a href="/user" class="layui-btn layui-btn-primary">返回用户列表</a>
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

        //提交
        /* 自定义验证规则 */
        form.verify({
            username: function(value){
                var errorMsg = '用户名格式为6-15位！';
                //密码是否必须为6-15位字母或数字
                if (!(value.length >= 6 && value.length <= 15)) {
                    return errorMsg;
                }
            },
            password: function(value){
                var errorMsg = '密码必须为6-15位字母或数字！';
                //密码是否必须为6-15位字母或数字
                if (!/^[a-zA-Z0-9]{6,15}$/.test(value)) {
                    return errorMsg;
                }
            },
        });

        form.on('submit(submit-btn)', function(data){
            layer.load(1, {shade: .1});
            var _this = this;_this.disabled=true;//防止多次提交
            var params = data.field;

            $.ajax({
                type: "post",
                url: "",
                data: params,
                dataType: "json",
                success: function(data) {
                    layer.closeAll();
                    if(data.code == 100000){
                        layer.msg(data.message, {icon: 1,time:1500}, function(){
                            window.location.href = data.url;
                        })
                    }else{
                        layer.msg(data.message,{icon: 5,time:1500}, function(){
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