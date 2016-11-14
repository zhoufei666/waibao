<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>后台管理系统</title>
    <meta name="keywords" content="关键字">
    <meta name="description" content="描述">

    <!-- 公共css、font-awesome -->
    <link href="{{ asset('assets/admin/css/bootstrap.min.css?v=3.4.0')}}" rel="stylesheet">
    <link href="{{ asset('assets/Common/font-awesome/css/font-awesome.css?v=4.3.0') }}" rel="stylesheet">

    <!-- Morris -->
    <link href="{{ asset('assets/admin/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('assets/admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.css?v=2.2.0')}}" rel="stylesheet">
    <!-- 公共css、js、font-awesome -->

    <!-- 自定义css start  -->
        <!-- 区块占位 -->
        @yield('css')
    <!-- 自定义css end  -->

</head>

<body>
    <div id="wrapper">
        <!-- 包含子视图 -->
        @include('admin.Common.left_bar')       

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!-- 右边 管理 内容 -->
            @yield('content')
        </div>
    </div>


    <!-- 公共js start -->
    <!-- Mainly scripts -->
    <script src="{{ asset('assets/admin/js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js?v=3.4.0')}}"></script>
    <script src="{{ asset('assets/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{ asset('assets/admin/js/hplus.js?v=2.2.0')}}j"></script>
    <script src="{ asset('assets/admin/js/plugins/pace/pace.min.js')}}"></script>

    <!-- 公共js end -->

    <!-- 自定义js start  -->
        <!-- 区块占位 -->
        @yield('javascript')
    <!-- 自定义js end  -->
    
</body>

</html>