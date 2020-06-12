<?php
use kucha\ueditor\UEditor;
?>
<link rel="stylesheet" href="/asset/style/jquery.tagsinput.css">
<?php //var_dump($data['news']['tag_join']); ?>
<?php //var_dump(\yii\helpers\Json::encode($data));die;?>
<div class="layui-card">
    <div class="layui-card-header header-title"><?=isset($_GET['id']) ? '修改轮播图' : '添加轮播图'?></div>
    <div class="layui-card-body">
        <form class="layui-form" action="">

            <div class="layui-form-item">
                <label class="layui-form-label">联系人姓名</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['contact']['name']) ? $data['contact']['name'] : ''?>" name="name" autocomplete="off" placeholder="请输入联系人姓名" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系人电话</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify="tel" value="<?=isset($data['contact']['tel']) ? $data['contact']['tel'] : ''?>" name="tel" autocomplete="off" placeholder="请输入联系人电话" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="submit-btn">立即提交</button>
                    <a href="javascript:history.go(-1);" class="layui-btn layui-btn-primary">返回</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form'], function(){

        var $ = layui.$,
            form = layui.form;

        form.verify({
            tel: [
                /^1[0-9]{10}$/
                ,'手机号必须是11位数字'
            ]
        });


        /* 监听提交 */
        form.on('submit(submit-btn)', function(data) {
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
                    _this.disabled=false;
                    layer.confirm(res.message+'是否返回列表？', {
                        btn: ['确定','取消'] //按钮
                    }, function(){
                        history.go(-1);
                    }, function(){
                        layer.closeAll();
                        window.location.reload();
                    });
                },
                error: function(){
                    layer.closeAll();
                    _this.disabled=false;
                    layer.msg('操作失败', {icon: 1}, function(){
                        window.location.reload();
                    })
                }
            });
            return false;
        })
    });
</script>