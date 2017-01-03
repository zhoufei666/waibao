<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>后台管理系统-登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="填写你的描述">

	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="{{asset('assets/Common/font-awesome/css/font-awesome.css?v=4.3.0')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css?v=2.2.0')}}">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h3 class="logo-name"> 修改密码 </h3>
            </div>

            <h3>欢迎使用 </h3>

            <form action="{{ url('admin/update_password') }}" method="post" class="form-horizontal" validate='true'>
                <div class="form-group">
                    <input type="text" name='username' class="form-control required" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control required" placeholder="密码" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="captcha" class="form-control half-width" minlength="4" maxlength="4" placeholder="验证码" required=""   style="padding: 10px;" title="请填写4位验证码">
                    <img src="" onclick="re_captcha()" class="form-control half-width pointer" id="captcha" style="padding: 2px;">
                    
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b ajax-post " target-form='form-horizontal'>修 改</button>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">


            </form>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/Common/validate/validate.css')}}">
    <!-- <script type="text/javascript" src="{{asset('assets/Common/validate/jquery-validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/Common/validate/validate.message.js')}}"></script -->

    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/Common/validate/ajax.js')}}"></script>

    <script type="text/javascript">
        $(function(){
            re_captcha();
        });
        function re_captcha() {
            var imgType = '{{$_GET["imgType"]??""}}';
            
            var url = "{{ URL('getCaptchaSrc') }}" ;
            if (imgType != '') {
                url  = url + '?imgType=' +imgType;
            }
            
            $.get(url,'',function(src){
                document.getElementById('captcha').src=src;
            });     
        } 
    </script>

</body>

</html>
