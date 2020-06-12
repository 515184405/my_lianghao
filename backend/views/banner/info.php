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
                <label class="layui-form-label">介绍描述</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['banner']['desc']) ? $data['banner']['desc'] : ''?>" name="desc" autocomplete="off" placeholder="请输入活动描述（选填）" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">活动链接</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['banner']['url']) ? $data['banner']['url'] : ''?>" name="url" autocomplete="off" placeholder="请输入活动链接（选填）" class="layui-input">
                </div>
            </div>

            <div id="wx_link" class="layui-form-item ">
                <label class="layui-form-label">轮播图</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-primary js_upload_image" id="test-upload-normal">上传图片</button><span class="theme-red ml10">图片大小不要超过2M</span>
                    <input type="hidden" lay-verify="required" lay-text="轮播图必填" value="<?=isset($data['banner']['imgsrc']) ? $data['banner']['imgsrc'] : ''?>" class="js_banner_url" name="imgsrc">
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" <?=isset($data['banner']['imgsrc']) ? 'src="'.$data['banner']['imgsrc'].'"' : ''?>" id="test-upload-normal-img">
                        <p id="test-upload-demoText"></p>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['banner']['sort']) ? $data['banner']['sort'] : ''?>" name="sort" autocomplete="off" placeholder="请输入排序（选填）" class="layui-input">
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
        tagsInput:'../lib/jquery.tagsinput.min'
    }).use(['index', 'form','upload','tagsInput'], function(){

        var $ = layui.$,
            upload = layui.upload,
            form = layui.form;

        // 文件上传
        //普通图片上传
         var uploadInst = upload.render({
                elem: '#test-upload-normal'
                , url: '/banner/upload-image'
                ,data:{
                    fileName : 'banner_url',
                    caseDir : 'banner/'
                }
                , before: function (obj) {
                    layer.msg('上传中...', {
                        icon: 16,
                        time: 0,
                        shade: [0.1, '#000']
                    });
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#test-upload-normal-img').attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    layer.closeAll();
                    //上传成功
                    if(res.code == 100000){
                        $('.js_'+res.data.fileName).val(res.data.fileSrc);
                        return layer.msg('上传成功',{icon:1});
                    }
                    //如果上传失败
                    if (res.code == 100001) {
                        return layer.msg('上传失败');
                    }
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = $('#test-upload-demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            })

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
                        //window.location.reload();
                    })
                }
            });
            return false;
        })
    });
</script>