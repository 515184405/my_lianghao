<?php
use kucha\ueditor\UEditor;
?>
<?php //var_dump($data['widget']['type']); ?>
<?php //var_dump(\yii\helpers\Json::encode($data));die;?>
<link rel="stylesheet" href="/asset/lib/select2/css/select2.min.css">
<link rel="stylesheet" href="/asset/style/jquery.tagsinput.css">
<style>
    .select2-container--default.select2-container--focus .select2-selection--multiple{
        padding-right:50px;
    }
    .relative{
        position: relative;
    }
    .add_type{
        position: absolute;
        right: 8px;
        top:8px;
        z-index: 9;
    }
</style>
<div class="layui-card">
    <div class="layui-card-header header-title"><?=isset($_GET['id']) ? '修改作品' : '添加作品'?></div>
    <div class="layui-card-body">
        <form class="layui-form" action="">

            <div id="wx_link" class="layui-form-item ">
                <label class="layui-form-label">作品压缩包</label>
                <div class="layui-input-block">
                    <button type="button" class="layui-btn layui-btn-primary js_upload_image" id="upload-zip">上传文件</button><span class="theme-red ml10">格式为：zip|rar</span>
                    <input type="hidden" value="<?=isset($data['widget']['download']) ? $data['widget']['download'] : ''?>" class="js_website" name="website">
                    <a href="<?=isset($data['widget']['download']) ? Yii::$app->params['frontend_url'].$data['widget']['download'] : ''?>" id="zip-upload-demoText"><?=isset($data['widget']['download']) ? Yii::$app->params['frontend_url'].$data['widget']['download'] : ''?></a>
                </div>
            </div>
        </form>
    </div>
</div>



<script>

    var frontend_url = "Yii::$app->params['frontend_url']";

    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form','upload'], function(){

        var $ = layui.$,
            upload = layui.upload,
            form = layui.form;


        //压缩包上传
        //选完文件后不自动上传
        upload.render({
            elem: '#upload-zip'
            ,url: '/site/upload-file'
            ,accept: 'file' //普通文件
            ,exts: 'zip|rar' //只允许上传压缩文件
            // ,auto: false
            ,bindAction: '#upload-file-submit'
            ,done: function(res){

                layer.closeAll();
                if(res.code == 100000){
                    $("#zip-upload-demoText").attr('href',frontend_url+res.download).html(res.name);
                    $('.js_website').val(res.download);
                }

            }
        });





    });
</script>