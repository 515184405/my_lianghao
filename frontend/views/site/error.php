<?php $this->context->layout = false ?>
<?php $userInfo = $this->params['userInfo']; ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>313组件库 - 404页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <style type="text/css">
        * {margin:0px;padding:0px;list-style:none;text-decoration:none;}
        body {background:url('<?=Yii::$app->params['backend_url']?>/asset/image/b1.jpg')}
        html,body,.mian {width:100%;height:100%;background:#fdf7e1 url('<?=Yii::$app->params['backend_url']?>/asset/image/back.jpg') no-repeat center;}
        .error_div {width:230px;position:fixed;left:50%;top:63%;font-family:"微软雅黑"}
        .error_div a {
            color: #FFFBF0;
            width: 100px;
            background: #8A532A;
            text-align: center;
            line-height: 38px;
            height: 38px;
            display: inline-block;
            font-size: 15px;
            -webkit-border-radius: 1px;
            -moz-border-radius: 1px;
            border-radius: 1px;
            margin-bottom:10px;
            margin-right:10px;
        }
        .error_div a:hover {background:#7B4A26;}
        .info {line-height:20px;color: #544545;font-size: 14px;}
    </style>
    <script type="text/javascript">
        var InterValObj; //timer变量，控制时间
        var count=5;
        var curCount;

        function SetRemainTime() {
            if (curCount == 0) {
                window.clearInterval(InterValObj);//停止计时器
                window.setTimeout("window.location='/'",0);
            }
            else {
                curCount--;
                document.getElementById("redirect_info").innerHTML=(curCount+"秒后返回首页");
            }
        }
    </script>
</head>
<body>
<div class="mian">
    <div class="error_div">
        <a href="/">返回首页</a><a href="javascript:history.go(-1);">返回上一步</a>
        <div id="redirect_info" class="info">5秒后返回首页</div>
        <script type="text/javascript">
            curCount=count;
            InterValObj = window.setInterval(SetRemainTime, 1000);
        </script>
    </div>
</div>
</body>
</html>

