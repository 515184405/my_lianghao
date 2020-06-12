<?=$this->render('../../../common/widgets/code/index');?>
<!--<style>
    .dir-list{
        border:1px solid #eee;
    }
    .dir-list li{
        line-height: 45px;
        padding-left:20px;
        border-bottom: 1px solid #eee;
    }
    .dir-list li:last-child{
        border-bottom: 0;
    }
    .dir-list li .iconfont{
        margin-right:5px;
    }
</style>
<ul class="dir-list">
    <?php /*foreach ($result as $key=>$val){*/?>
    <li><a href="/widget/params?id=<?/*=$_GET['id']*/?>&dir=<?/*=$path.$val['dir']*/?>/"><i class="iconfont"><?/*=$val['type'] == 1 ? "&#xe638;" : "&#xe60c;";*/?></i><?/*=$val['dir']*/?></a></li>
    <?php /*} */?>
</ul>-->

<script>
    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index'], function() {
        var $ = layui.$
    })
</script>