<style>
    .colorpicker {
        position: absolute;
        right: -10px;
        top: 0;
    }
    .none{
        display: none;
    }
</style>
<div class="layui-card">
    <div class="layui-card-header header-title"><?=isset($_GET['id']) ? '修改轮播图' : '添加轮播图'?></div>
    <div class="layui-card-body">
        <form class="layui-form" action="">

            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['nav']['name']) ? $data['nav']['name'] : ''?>" name="name" autocomplete="off" placeholder="请输入标题" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">筛选条件</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['nav']['url']) ? $data['nav']['url'] : ''?>" name="url" autocomplete="off" placeholder="请输入活动链接（选填）" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否设置图片</label>
                <div class="layui-input-block">
                    <?php
                    $isImage = false;
                    if(isset($data['nav']['imgsrc']) && $data['nav']['imgsrc'] !== ''){
                        $isImage = true;
                    }?>
                    <input type="checkbox" name="recommend" value="" <?=$isImage ? 'checked' : '';?> lay-skin="switch" lay-text="是|否" lay-filter="filter-recommend" >
                </div>
            </div>

            <div id="iconColor" class="layui-form-item <?=$isImage ? 'none' : ''?>">
                <label class="layui-form-label">图标颜色</label>
                <div class="layui-input-inline">
                    <input type="text" value="<?=isset($data['nav']['color']) ? $data['nav']['color'] : ''?>" name="color" autocomplete="off" placeholder="请点选右侧图标" class="layui-input">
                    <div class="colorpicker" id="colorpicker"></div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否设置快捷导航</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="is_recommend" value="" <?=(isset($data['nav']['is_recommend']) && $data['nav']['is_recommend']==1) ? 'checked' : '';?> lay-skin="switch" lay-text="是|否" >
                </div>
            </div>

            <div id="iconImage" class="layui-form-item <?=!$isImage ? 'none' : ''?>">
                <label class="layui-form-label">快捷图标</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-primary js_upload_image" id="test-upload-normal">上传图片</button><span class="theme-red ml10">图片大小不要超过2M ，图片尺寸100x100（非必填）,</span>
                    <input type="hidden" lay-text="轮播图必填" value="<?=isset($data['nav']['imgsrc']) ? $data['nav']['imgsrc'] : ''?>" class="js_nav_url" name="imgsrc">
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" <?=isset($data['nav']['imgsrc']) ? 'src="'.$data['nav']['imgsrc'].'"' : ''?>" id="test-upload-normal-img">
                        <p id="test-upload-demoText"></p>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['nav']['sort']) ? $data['nav']['sort'] : ''?>" name="sort" autocomplete="off" placeholder="请输入排序（选填）" class="layui-input">
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
    }).use(['index', 'form','upload','colorpicker'], function(){

        var $ = layui.$,
            upload = layui.upload,
            colorpicker = layui.colorpicker,
            form = layui.form;

        colorpicker.render({
            elem: '#colorpicker',  //绑定元素
            color: "<?=isset($data['nav']['color']) ? $data['nav']['color'] : '#f00000'?>",
            done: function (color) {
                $('#colorpicker').prev('input').val(color);
            }
        })

        // 推荐单选开关事件
        form.on('switch(filter-recommend)',function(res){
           if(res.elem.checked){
               $("#iconColor").hide();
               $("#iconImage").show();
           }else{
               $("#iconImage").hide();
               $("#iconImage").find('input').val('');
               $("#iconColor").show();
           }
        })

            // 文件上传
        //普通图片上传
         var uploadInst = upload.render({
                elem: '#test-upload-normal'
                , url: '/banner/upload-image'
                ,data:{
                    fileName : 'nav_url',
                    caseDir : 'nav/'
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
            params['is_recommend'] = params['is_recommend'] ? 1 : 0;
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