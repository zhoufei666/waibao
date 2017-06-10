@extends('Public.Home.common')


@section('css')
    <link rel="stylesheet" media="screen and (min-width:300px) and (max-device-width:800px)" href="{{asset('assets/Common/Css/index_min.css?v=3')}}"/>
@stop

@section('content')
    <div class="img_box">
        
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/1.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/1.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/2.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/2.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/3.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/3.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/4.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/4.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/5.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/5.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/6.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/6.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/7.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/7.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/5.jpg" title="我是大图片" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/we/birthday.jpg" alt=""> 
            </div>
        </div>
        <div class="img_item">
            <div class="lightCon"> 
                <span class="hoverBox"> 
                    <img src="assets/Home/Image/we/5.jpg" title="喜欢，就去关注我的微信吧" alt="">
                </span> 
                <img class="basic_img" src="assets/Home/Image/wechat.jpg" alt=""> 
            </div>
        </div>

    </div>
        


    <!-- 小图片放大看大图及详细信息 -->
    <div class="hoverBox_show">
        <div class="hoverBox_show_img">
                <div class="big_img">
                    <div class=" big_img_box">
                        <img src="" alt="">     
                    </div>               
                </div>

                <div class="img_info">
                    <span class="title">123</span>
                    <span class="close">X</span>
                </div>
        </div>
    </div>



@stop

@section('script')
    <script>
        $(function(){
            //点击显示大图片
            $('.basic_img').click(function () {
                var full_content_height = $('.full-content').outerHeight(true)+30; //整个画面div

                var body_width = $('.full-content').width();

                //赋值图片
                var big_img_src = $(this).siblings('.hoverBox ').find('img').attr('src');
                $('.big_img img').attr("src",big_img_src);
                //赋值标题
                var big_img_title =  $(this).siblings('.hoverBox ').find('img').attr('title');
                $('.big_img img').attr('title',big_img_title);
                
                $('.hoverBox_show').show().css('height',full_content_height);//蒙版显示
                
                $('.big_img').css('height','1rem').animate({width:'90%'},500);
                $('.big_img').animate({height:body_width*0.8},500);
                
                //显示文字标题
                $('.img_info').animate({height:"3rem"},500);
                $('.img_info .title').text(big_img_title);
                
            });

            //关闭蒙版
            $('.close').click(function () {
                $('.hoverBox_show').hide();
            });
        });
    </script>
@stop