<?php $userInfo = $this->params['userInfo']; ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>313组件库后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/asset/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/asset/style/admin.css" media="all">
    <script src="/asset/layui/layui.js"></script>
</head>
<body class="layui-layout-body">

<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect>
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="<?= Yii::$app->params['frontend_url']; ?>" target="_blank" title="前台">
                        <i class="layui-icon layui-icon-website"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search" layadmin-event="serach" lay-action="template/search.html?keywords=">
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

                <li class="layui-nav-item" lay-unselect>
                    <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
                        <i class="layui-icon layui-icon-notice"></i>

                        <!-- 如果有新消息，则显示小圆点 -->
                        <span class="layui-badge-dot"></span>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;">
                        <cite><?=Yii::$app->view->params['userInfo']['username']?></cite>
                    </a>
                    <dl class="layui-nav-child">
<!--                        <dd><a lay-href="set/user/info.html">基本资料</a></dd>-->
                        <dd><a href="/user/info?id=<?=Yii::$app->user->getId();?>">修改密码 </a></dd>
                        <hr>
                        <dd style="text-align: center;"><a href="/site/logout">退出</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="about"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
                    <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>

        <!-- 侧边菜单 -->
        <div id="layui-side-menu" class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="home/console.html">
                    <span><img style="width: 135px;margin-top:-15px;" src="/asset/image/logo-fff.png" alt=""></span>
                </div>

                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
                    <li data-name="home" class="layui-nav-item">
                        <a href="/" class="" lay-tips="控制台" lay-direction="2">
                            <i class="layui-icon iconfont font-1">&#xe630;</i>
                            <cite>控制台</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/banner"  class="" lay-tips="轮播管理" lay-direction="2">
                            <i class="layui-icon iconfont font-2">&#xe675;</i>
                            <cite>轮播管理</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/nav"  class="" lay-tips="轮播管理" lay-direction="6">
                            <i class="layui-icon iconfont font-2">&#xe675;</i>
                            <cite>快捷导航管理</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/number-list"  class="" lay-tips="号码管理" lay-direction="3">
                            <i class="layui-icon iconfont font-3">&#xe64a;</i>
                            <cite>号码管理</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/call"  class="" lay-tips="联系人管理" lay-direction="3">
                            <i class="layui-icon iconfont font-3">&#xe64a;</i>
                            <cite>联系人管理</cite>
                        </a>
                    </li>
                  <!--  <li data-name="home" class="layui-nav-item">
                        <a href="/widget"  class="" lay-tips="组件管理" lay-direction="4">
                            <i class="layui-icon iconfont font-4">&#xe617;</i>
                            <cite>组件管理</cite>
                        </a>
                    </li>-->
                    <!--<li data-name="home" class="layui-nav-item">
                        <a href="/news" lay-tips="文章管理" lay-direction="2">
                            <i class="layui-icon iconfont font-5">&#xe681;</i>
                            <cite>文章管理</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/site/zixun" lay-tips="网站咨询" lay-direction="2">
                            <i class="layui-icon iconfont font-6">&#xe700;</i>
                            <cite>网站咨询</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/dingzhi" lay-tips="组件定制" lay-direction="2">
                            <i class="layui-icon iconfont font-7">&#xe61a;</i>
                            <cite>组件定制</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/member" lay-tips="用户列表" lay-direction="2">
                            <i class="layui-icon iconfont font-8">&#xe625;</i>
                            <cite>用户列表</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/down-history" lay-tips="下载历史" lay-direction="2">
                            <i class="layui-icon iconfont font-8">&#xe602;</i>
                            <cite>下载历史</cite>
                        </a>
                    </li>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/team" lay-tips="人员管理" lay-direction="2">
                            <i class="layui-icon iconfont font-8">&#xe76a;</i>
                            <cite>人员管理</cite>
                        </a>
                    </li>-->
                    <?php if($userInfo['type'] == 1){ ?>
                    <li data-name="home" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="用户管理" lay-direction="2">
                            <i class="layui-icon iconfont font-9">&#xe625;</i>
                            <cite>管理员管理</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="/user">管理员列表</a>
                            </dd>
                            <dd >
                                <a href="/user/info">添加管理员 </a>
                            </dd>
                            <dd >
                                <a href="/user/info?id=<?=Yii::$app->user->getId();?>">修改密码 </a>
                            </dd>
                        </dl>
                    </li>
                    <?php }else{ ?>
                    <li data-name="home" class="layui-nav-item">
                        <a href="/user/info?id=<?=Yii::$app->user->getId();?>" lay-tips="修改密码" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>修改密码</cite>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-fluid layui-show">
                <!--内容部分-->
                <?php $this->beginBody() ?>
                <div class="wrapper">
                    <?= $content ?>
                </div>
                <?php $this->endBody() ?>
                <!--内容部分-->
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>


