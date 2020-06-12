<?php
use common\models\Widget;
use common\models\MadeToOrder;
use common\models\Zixun;
?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
       欢迎登录....
    </div>
</div>
<script>


    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index']);
</script>

