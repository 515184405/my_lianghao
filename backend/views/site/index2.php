<?php
    use common\models\Widget;
    use common\models\MadeToOrder;
    use common\models\Zixun;
?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">快捷方式</div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                                <div carousel-item>
                                    <ul class="layui-row layui-col-space10">
                                        <li class="layui-col-xs4">
                                            <a href="/banner/info">
                                                <i class="layui-icon iconfont font-1">&#xe675;</i>
                                                <cite>轮播</cite>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs4">
                                            <a href="cases/info">
                                                <i class="layui-icon iconfont font-2">&#xe64a;</i>
                                                <cite>案例</cite>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs4">
                                            <a href="widget/info">
                                                <i class="layui-icon iconfont font-3">&#xe617;</i>
                                                <cite>组件</cite>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs4">
                                            <a href="/news/info">
                                                <i class="layui-icon iconfont font-4">&#xe681;</i>
                                                <cite>文章</cite>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs4">
                                            <a href="/site/zixun">
                                                <i class="layui-icon iconfont font-5">&#xe700;</i>
                                                <cite>咨询</cite>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs4">
                                            <a href="/dingzhi">
                                                <i class="layui-icon iconfont font-6">&#xe61a;</i>
                                                <cite>组件定制</cite>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">待办事项</div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-backlog">
                                <div carousel-item>
                                    <ul class="layui-row layui-col-space10">
                                        <li class="layui-col-xs6">
                                            <a href="/widget?status=0" class="layadmin-backlog-body">
                                                <h3>组件待审</h3>
                                                <p><cite class="font-7"><?=Widget::widgetStatus(); ?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a href="/dingzhi?status=0" class="layadmin-backlog-body">
                                                <h3>组件定制待处理</h3>
                                                <p><cite class="font-8"><?=MadeToOrder::dingZhiStatus();?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a href="/site/zixun?status=0" class="layadmin-backlog-body">
                                                <h3>网站咨询待联系</h3>
                                                <p><cite class="font-9"><?=Zixun::zixunStatus()['modelStatus0'];?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs6">
                                            <a href="javascript:;" class="layadmin-backlog-body">
                                                <h3>今日新增用户</h3>
                                                <p><cite class="font-5"><?=\common\models\Member::todayInsert()?></cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据概览</div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">
                                <div carousel-item class="LAY-index-dataview">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>

                        </div>
                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">
                                <div carousel-item class="LAY-index-dataview">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>

                        </div>
                       <!-- <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">
                                <div carousel-item class="LAY-index-dataview">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>

                        </div>-->
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">版本信息</div>
                <div class="layui-card-body layui-text">
                    <table class="layui-table">
                        <colgroup>
                            <col width="100">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>当前版本</td>
                            <td>
                                <script type="text/html" template>
                                    v{{ layui.admin.v }}
                                    <a href="http://fly.layui.com/docs/3/" target="_blank" style="padding-left: 15px;">更新日志</a>
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>基于框架</td>
                            <td>
                                <script type="text/html" template>
                                    layui-v{{ layui.v }}
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>主要特色</td>
                            <td>零门槛 / 响应式 / 清爽 / 极简</td>
                        </tr>
                        <tr>
                            <td>获取渠道</td>
                            <td style="padding-bottom: 0;">
                                <div class="layui-btn-container">
                                    <a href="http://www.layui.com/admin/" target="_blank" class="layui-btn layui-btn-danger">获取授权</a>
                                    <a href="http://fly.layui.com/download/layuiAdmin/" target="_blank" class="layui-btn">立即下载</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">效果报告</div>
                <div class="layui-card-body layadmin-takerates">
                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>转化率（日同比 28% <span class="layui-edge layui-edge-top" lay-tips="增长" lay-offset="-15"></span>）</h3>
                        <div class="layui-progress-bar" lay-percent="65%"></div>
                    </div>
                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>签到率（日同比 11% <span class="layui-edge layui-edge-bottom" lay-tips="下降" lay-offset="-15"></span>）</h3>
                        <div class="layui-progress-bar" lay-percent="32%"></div>
                    </div>
                </div>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">实时监控</div>
                <div class="layui-card-body layadmin-takerates">
                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>CPU使用率</h3>
                        <div class="layui-progress-bar" lay-percent="58%"></div>
                    </div>
                    <div class="layui-progress" lay-showPercent="yes">
                        <h3>内存占用率</h3>
                        <div class="layui-progress-bar layui-bg-red" lay-percent="90%"></div>
                    </div>
                </div>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">产品动态</div>
                <div class="layui-card-body">
                    <div class="layui-carousel layadmin-carousel layadmin-news" data-autoplay="true" data-anim="fade" lay-filter="news">
                        <div carousel-item>
                            <div><a href="http://fly.layui.com/docs/2/" target="_blank" class="layui-bg-red">layuiAdmin 快速上手文档</a></div>
                            <div><a href="http://fly.layui.com/vipclub/list/layuiadmin/" target="_blank" class="layui-bg-green">layuiAdmin 会员讨论专区</a></div>
                            <div><a href="http://www.layui.com/admin/#get" target="_blank" class="layui-bg-blue">获得 layui 官方后台模板系统</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-card">
                <div class="layui-card-header">
                    作者心语
                    <i class="layui-icon layui-icon-tips" lay-tips="要支持的噢" lay-offset="5"></i>
                </div>
                <div class="layui-card-body layui-text layadmin-text">
                    <p>一直以来，layui 秉承无偿开源的初心，虔诚致力于服务各层次前后端 Web 开发者，在商业横飞的当今时代，这一信念从未动摇。即便身单力薄，仍然重拾决心，埋头造轮，以尽可能地填补产品本身的缺口。</p>
                    <p>在过去的一段的时间，我一直在寻求持久之道，已维持你眼前所见的一切。而 layuiAdmin 是我们尝试解决的手段之一。我相信真正有爱于 layui 生态的你，定然不会错过这一拥抱吧。</p>
                    <p>子曰：君子不用防，小人防不住。请务必通过官网正规渠道，获得 <a href="http://www.layui.com/admin/" target="_blank">layuiAdmin</a>！</p>
                    <p>—— 贤心（<a href="http://www.layui.com/" target="_blank">layui.com</a>）</p>
                </div>
            </div>
        </div>-->
    </div>
</div>
<script>

    //今日访问量数据
    window.todayCount = JSON.parse('<?= \common\models\Visit::todayCount();?>');
    // 今日访问量key
    window.todayKey = [];
    // 今日访问量val
    window.todayVal = [];
    for(var key in todayCount){
        window.todayKey.push(key);
        window.todayVal.push(todayCount[key].length);
    };
    console.log(todayCount);

    //浏览器分布
    var browser = JSON.parse('<?=\common\models\Visit::browser();?>');
    window.browserKey = [];
    window.browserVal = [];
    for(var key1 in browser){
        window.browserKey.push(key1);
        window.browserVal.push({name:key1,value:browser[key1]});
    }

    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console']);
</script>

