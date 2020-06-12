
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>聚友登录</title>
    <meta name="keywords" content="网站建设,专业网站建设团队,网站设计,网站制作,做网站"/>
    <meta name="description" content="北京聚友开发小组团队,专业从事网站建设.高品质建站服务.丰富的网站建设经验,响应式网站设计、网站制作开发"/>

    <link rel="stylesheet" href="/asset/static/css/default.css<?=Yii::$app->params['static_number']?>">
    <script src="/asset/static/wigdet/jquery.min.js"></script>
    <script src="/asset/static/wigdet/layer/layer.js"></script>
    <style>
        html{
            overflow: hidden;
        }
        canvas{
            position: fixed;
            left: 0;
            top:0;
        }
        .login-title{
            margin-top:0;
            height:130px;
        }
        .login-title img {
             width: 220px;
            margin-top: -35px;
        }
        .login{
            background-color: #fff;
        }
        .fy-login{
            padding-top:20px;
        }
        @media screen and (min-width: 769px){
            .login{
                width:500px;
                height:400px;
                position: absolute;
                top:50%;
                left:50%;
                margin-top:-210px;
                margin-left: -250px;
                background-color: #fff;
            }
        }
    </style>
</head>
<body>
<!--首页背景-->
<canvas id="canvas" class="canvas-cls"></canvas>
<!--首页背景-->
<!--登陆模块-->
<div class="login layui-login fy-login t-c" id="user_login">
    <h2 class="login-title"><img src="/asset/static/image/logo2.png" alt=""></h2>
    <!--    <p class="login-desc">用户登录</p>-->
    <div class="login-type">
        <a target="_blank" href="/site/qqlogin">
            <i class="iconfont transition">&#xe608;</i>
            <p>Q Q 登陆</p>
        </a>
        <a target="_blank" href="<?=$weiboUrl?>">
            <i class="iconfont transition">&#xe610;</i>
            <p>新浪登陆</p>
        </a>
    </div>
    <div class="t-c login-bottom">
        <p class="reigster-agree"><i class="iagree_btn theme iconfont">&#xe6a2;</i>我已阅读并接受 <a target="_blank" class="register-advice" href="javascript:;">《注册声明》与《版权声明》</a></p>
        <span >没有账号？<a class="theme register_btn" href="javascript:;">立即注册</a></span>
    </div>
</div>
<!--登陆模块-->
<!--注册模块-->
<div class="login t-c none" id="user_register">
    <h2 class="login-title"><img src="/asset/static/image/logo2.png" alt=""></h2>
    <!--    <p class="login-desc">用户注册</p>-->
    <div class="login-type">
        <a target="_blank" href="/site/qqlogin">
            <i class="iconfont transition">&#xe608;</i>
            <p>Q Q 注册</p>
        </a>
        <a target="_blank"  href="<?=$weiboUrl?>">
            <i class="iconfont transition">&#xe610;</i>
            <p>新浪注册</p>
        </a>
    </div>
    <div class="t-c login-bottom">
        <p class="reigster-agree"><i class="iagree_btn theme iconfont">&#xe6a2;</i>我已阅读并接受 <a target="_blank" class="register-advice" href="javascript:;">《注册声明》与《版权声明》</a></p>
        <span>已有账号？<a class="theme login_btn" href="javascript:;">立即登陆</a></span>
    </div>
</div>
<!--注册模块-->
<!--协议模块-->
<div class="xieyi none">
    <h2>注册声明</h2>
    <p>一、用户注册、登陆，视为接受本协议的约束。</p>
    <p>二、用户承诺遵守国家的法律法规及部门规章</p>
    <p>三、用户承诺遵守“313组件库”的知识产权政策.</p>
    <p>四、站内插件用于行业交流、学习。</p>
    <p>五、用户侵犯第三人的知识产权，由该用户承担全部法律责任。</p>

    <h2>版权声明</h2>
    <p>313组件库（www.yu313.cn）站内所有涉及插件及代码由会员或站主上传而来，313组件库不拥有会员上传的插件及代码的版权</p>
    <p>313组件库作为网络服务提供者，对非法转载，盗版行为的发生不具备充分的监控能力。但是当版权拥有者提出侵权指控并出示充分的版权证明材料时，313组件库负有移除盗版和非法转载作品以及停止继续传播的义务。313组件库在满足前款条件下采取移除等相应措施后不为此向原发布人承担违约责任或其他法律责任，包括不承担因侵权指控不成立而给原发布人带来损害的赔偿责任。</p>
    <p>如果版权拥有者发现自己作品被侵权，请及时向313组件库提出权利通知，并将姓名、电话、身份证明、权属证明、具体链接（URL）及详细侵权情况描述发往版权举报专用通道，313组件库在收到相关举报文件后，在3个工作日内移除相关涉嫌侵权的内容</p>
    <p>QQ：515184405（周一到周五，9：30-18:00）</p>
</div>
<!--协议模块-->

<script>
    $(".login_btn").click(function() {
        layer.closeAll();
    })

    //必须统一才能注册
    $('.iagree_btn').click(function(){
        layer.msg('登录/注册必须同意该协议',{
            icon:"4"
        })
    });

    //用户协议
    $('.register-advice').click(function(){

        layer.open({
            type: 1,
            title: '<h1 style="color:#000;font-size:15px;">注册声明与版权声明</h1>',
            anim: 4,
            scrollbar:false,
            area: ['520px', '80%'],
            skin: 'layui-login layui-xieyi', //没有背景色
            content: $('.xieyi'),
            end:function(){
                $('.xieyi').hide();
            }
        });

    });

    /*弹出注册*/
    $(".register_btn").click(function(){
        layer.closeAll();
        layer.open({
            type: 1,
            title: ' ',
            area: ['520px','450px'],
            skin: 'layui-login', //没有背景色
            anim: 4,
            content: $('#user_register'),
            end:function(){
                $('#user_register').hide();
            }
        });
    });

    // window.requestAnimFrame 做兼容
    (function() {
        var lastTime = 0;
        var vendors = ['webkit', 'moz'];
        for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
            window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] ||    // Webkit中此取消方法的名字变了
                window[vendors[x] + 'CancelRequestAnimationFrame'];
        }

        if (!window.requestAnimationFrame) {
            window.requestAnimationFrame = function(callback, element) {
                var currTime = new Date().getTime();
                var timeToCall = Math.max(0, 16.7 - (currTime - lastTime));
                var id = window.setTimeout(function() {
                    callback(currTime + timeToCall);
                }, timeToCall);
                lastTime = currTime + timeToCall;
                return id;
            };
        }
        if (!window.cancelAnimationFrame) {
            window.cancelAnimationFrame = function(id) {
                clearTimeout(id);
            };
        }
    }());

    //增加背景动画
    var canvasFun = function(){
        var canvas = document.getElementById('canvas'),
            ctx = canvas.getContext('2d'),
            w = canvas.width = window.innerWidth,
            h = canvas.height =  window.innerHeight,

            hue = 217,
            stars = [],
            count = 0,
            maxStars = 1200;

        var canvas2 = document.createElement('canvas'),
            ctx2 = canvas2.getContext('2d');
        canvas2.width = 100;
        canvas2.height = 100;
        var half = canvas2.width / 2,
            gradient2 = ctx2.createRadialGradient(half, half, 0, half, half, half);
        gradient2.addColorStop(0.025, '#fff');
        gradient2.addColorStop(0.1, 'hsl(' + hue + ', 61%, 33%)');
        gradient2.addColorStop(0.25, 'hsl(' + hue + ', 64%, 6%)');
        gradient2.addColorStop(1, 'transparent');

        ctx2.fillStyle = gradient2;
        ctx2.beginPath();
        ctx2.arc(half, half, half, 0, Math.PI * 2);
        ctx2.fill();

        // End cache
        function random(min, max) {
            if (arguments.length < 2) {
                max = min;
                min = 0;
            }

            if (min > max) {
                var hold = max;
                max = min;
                min = hold;
            }

            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function maxOrbit(x, y) {
            var max = Math.max(x, y),
                diameter = Math.round(Math.sqrt(max * max + max * max));
            return diameter / 2;
        }

        var Star = function() {

            this.orbitRadius = random(maxOrbit(w, h));
            this.radius = random(60, this.orbitRadius) / 12;
            this.orbitX = w / 2;
            this.orbitY = h / 2;
            this.timePassed = random(0, maxStars);
            this.speed = random(this.orbitRadius) / 900000;
            this.alpha = random(2, 10) / 10;

            count++;
            stars[count] = this;
        }

        Star.prototype.draw = function() {
            var x = Math.sin(this.timePassed) * this.orbitRadius + this.orbitX,
                y = Math.cos(this.timePassed) * this.orbitRadius + this.orbitY,
                twinkle = random(10);

            if (twinkle === 1 && this.alpha > 0) {
                this.alpha -= 0.05;
            } else if (twinkle === 2 && this.alpha < 1) {
                this.alpha += 0.05;
            }

            ctx.globalAlpha = this.alpha;
            ctx.drawImage(canvas2, x - this.radius / 2, y - this.radius / 2, this.radius, this.radius);
            this.timePassed += this.speed;
        }

        for (var i = 0; i < maxStars; i++) {
            new Star();
        }

        function animation() {
            ctx.globalCompositeOperation = 'source-over';
            ctx.globalAlpha = 0.8;
            ctx.fillStyle = 'hsla(' + hue + ', 64%, 6%, 1)';
            ctx.fillRect(0, 0, w, h)

            ctx.globalCompositeOperation = 'lighter';
            for (var i = 1, l = stars.length; i < l; i++) {
                stars[i].draw();
            };

            window.requestAnimationFrame(animation);
        }

        animation();
    };
    canvasFun();
    window.onresize = canvasFun;
</script>
</body>
</html>
