<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<!-- 设置 meta 属性为 user-scalable=no 可以禁用其缩放（zooming）功能
	禁用缩放功能后，用户只能滚动屏幕，就能让你的网站看上去更像原生应用的感觉 -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">
	<meta name="keywords" content="周飞,摄影,交易" />
	<title>飞毛腿-摄影</title>

   	<link rel="stylesheet" href="{{asset('assets/Common/font-awesome/css/font-awesome.min.css')}}" >

   	<!-- 手机端样式 -->

   	<!-- 小屏幕 -->
	<link rel="stylesheet" media="screen and (min-width:300px) and (max-device-width:800px)" href="{{asset('assets/Common/Css/basic_min.css?v=3')}}"/>


   	<!-- 手机端样式 -->

   	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">



	<!-- 区块占位 -->
	@yield('css')
	<!-- 区块占位 -->
	@yield('javascript')
	

</head>
<body>
	<div id="wrap">
		<!-- 头部 -->
        @include('Public.Home.header')
        <!-- 头部广告 -->
        @include('Public.Home.header_ad')

        <div class="full-content">
	        <div id="content" class="container">
	            @yield('content')
	        </div>	
        </div>
        
        <!--end #content-->
        @include('Public.Home.footer')
    </div>
    <!--end #wrap-->
    <script type="text/javascript" src="{{asset('assets/Common/Js/jquery.min.js')}}"></script>
    @yield('script')
</body>
</html>