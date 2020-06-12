

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 - layuiAdmin</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/asset/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/asset/style/admin.css" media="all">
    <link rel="stylesheet" href="/asset/style/login.css" media="all">
    <style>
        html{
            overflow: hidden;
        }
        canvas{
            position: fixed;
            left: 0;
            top:0;
        }
        .layadmin-user-login-main{
            background-color: #fff;
            border:1px solid #333;
        }
    </style>
</head>
<body>
<!--首页背景-->
<canvas id="canvas" class="canvas-cls"></canvas>
<!--首页背景-->
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header" style="padding-bottom:0;">
            <h2><img style="width: 225px;opacity: .7;" src="<?=Yii::$app->params["frontend_url"]?>/asset/static/image/logo.png" alt=""></h2>
        </div>
        <div style="margin-top:-20px;" class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" lay-text="密码不能为空" placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item login-relative">
                <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-password"></label>
                <input type="text" name="verifyCode" placeholder="验证码" class="layui-input login-code">
                <img onclick='this.src="/site/captcha?c="+Math.random();' class="login-code-image" src="/site/captcha" alt="验证码">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid layui-btn-normal" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>
        </div>
    </div>
</div>

<script src="/asset/layui/layui.js"></script>
<script>

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

    layui.config({
        base: '/asset/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index','form'], function(){
        var $ = layui.$
            ,form = layui.form

        form.render();

        //提交
        /* 自定义验证规则 */
        form.verify({
            username: function(value){
                var errorMsg = '账号格式不正确！';
                //是否为手机号码
                if (value.length < 6) {
                    //是否为邮箱
                    return errorMsg;
                }
            },
        });

        //提交
        form.on('submit(LAY-user-login-submit)', function(data){
            layer.load(1, {shade: .1});
            $.ajax({
                type: "post",
                url: "",
                data: data.field,
                dataType: "json",
                success: function(data) {
                    layer.closeAll();
                    if(data.code == 100000){
                        layer.msg(data.message, {icon: 1,time:1500}, function(){
                           window.location.href='/site';
                        })
                    }else{
                        layer.msg(data.message,{icon: 5,time:1500}, function(){
                           window.location.reload();
                        })
                    }
                },
                error: function(){
                    // layer.closeAll();
                    // layer.msg("登录失败，请稍后再试！", function () {
                    //     window.location.reload();
                    // });
                }
            });
            return false;
        });





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
    });


</script>
</body>
</html>