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
    .layui-form-select dl{z-index:99999};
</style>
<?php $this->title="个人中心 - ".(isset($_GET['id']) ? '修改手机号信息' : '添加手机号'); ?>
<div class="layui-card">
    <div class="layui-card-header header-title"><?=isset($_GET['id']) ? '修改手机号信息' : '添加手机号'?></div>
    <div class="layui-card-body">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <div class="layui-input-block">
                    <input type="text" value="<?=isset($data['number_list']['tel']) ? $data['number_list']['tel'] : ''?>" name="tel" lay-verify="required" lay-text="手机号不能为空" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">单价</label>
                <div class="layui-input-block">
                    <input type="price" value="<?=isset($data['number_list']['price']) ? $data['number_list']['price'] : ''?>" name="price" lay-verify="required" lay-text="单价不能为空" autocomplete="off" placeholder="请输入单价" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">网络类型</label>
                <div class="layui-input-block">
                    <select  name="online" lay-verify="required">
                        <option <?=(isset($data['number_list']['online']) && $data['number_list']['online'] == 1) ? 'selected' : ''?> value="1">中国移动</option>
                        <option <?=(isset($data['number_list']['online']) && $data['number_list']['online'] == 2) ? 'selected' : ''?>  value="2">中国联通</option>
                        <option <?=(isset($data['number_list']['online']) && $data['number_list']['online'] == 3) ? 'selected' : ''?>  value="3">中国电信</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">归属地</label>
                <div class="layui-inline">
                    <select lay-filter="province" name="province" id="province" lay-verify="required">

                    </select>
                </div>
                <div class="layui-inline" id="city_select">

                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">套餐介绍</label>
                <div class="layui-input-block">
                    <textarea lay-verify="required" lay-text="套餐介绍" autocomplete="off" name="content" class="layui-textarea"   placeholder="请输入套餐介绍" id="" cols="30" rows="10"><?=isset($data['number_list']['content']) ? $data['number_list']['content'] : ''?></textarea>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">联系人</label>
                <div class="layui-input-block">
                    <select  name="user_tel" lay-verify="required">
                        <?php foreach ($data['contact'] as $key=>$val){ ?>
                            <option <?=(isset($data['number_list']['user_tel']) && $val['id'] == $data['number_list']['user_tel']) ? 'selected' : ''?> value="<?=$val['id']?>"><?=$val['name']?>-<?=$val['tel']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">是否推荐</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="is_recommend" <?=(isset($data['number_list']['is_recommend']) && $data['number_list']['is_recommend']) == 1 ? 'checked' : ''?> lay-skin="switch" lay-text="是|否" lay-filter="filter-recommend">
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


<script src="/china.js"></script>
<script>

    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form'], function(){

        var $ = layui.$,
            form = layui.form;

        var address = '<?=isset($data['number_list']['address']) ? $data['number_list']['address'] : "[]"?>'.split('-');
        var province = address[0];
        var city = address[1];

        /* 设置归属地数据 */
        function setAddressFun(){
            var options = '<option value="">请选择</option>';
            for(var key in china){
                options += '<option '+(province == key ? 'selected' : '')+' value="'+key+'">'+key+'</option>'
            }
            $("#province").html(options);
            form.render('select');
        }
        setAddressFun();

        form.on('select(province)',function(data){
            setCitysFun(data.value);
        })

        /* 设置城市数据 */
        function setCitysFun(value){
            if(value && china[value]){
                var options = ' <select lay-filter="city" name="city" id="city" lay-verify="required"><option value="">请选择</option>';
                for(var i=0,len = china[value].length;i < len;i++){
                    let item = china[value][i];
                    options += '<option '+(city == item ? 'selected' : '' )+' value="'+item+'">'+item+'</option>'
                }
                options += '</select>';
                $("#city_select").html(options);
                form.render('select');
            }
        }

        /* 自动添加 */
        if(city){
            setCitysFun(province);
        }

        /* 监听提交 */
        form.on('submit(submit-btn)', function(data) {
            layer.load(1, {shade: .1});
            var _this = this;_this.disabled=true;//防止多次提交
            var params = data.field;
            params['is_recommend'] =  params['is_recommend'] == 'on' ? 1 : 0;
            params['address'] =  params['province'] + '-' + params['city'];
            $.ajax({
                type: "post",
                url: "",
                data: params,
                dataType: "json",
                success: function(res) {
                    layer.closeAll();
                    _this.disabled=false;
                    layer.msg(res.message,{icon:1,time:1500},function(){
                        window.history.go(-1);
                    })
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