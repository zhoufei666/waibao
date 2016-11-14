<header class="header">
    <div class="container">
        <h1 class="logo">
            <a href="" title="摄影-飞毛腿">
                <img src="{{asset('assets/Common/Image/logo.png')}}">
                <span>飞毛腿乐园</span>
            </a>
        </h1>
        <div class="sitenav">
            <ul>
                <li id="menu-item-8" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-8"><a href="http://demo.themebetter.com/tob/">首页</a></li>
                <li id="menu-item-12" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-12"><a href="http://demo.themebetter.com/tob/tech">科技</a></li>
                <li id="menu-item-10" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-10"><a href="http://demo.themebetter.com/tob/inventor">发明</a></li>
                <li id="menu-item-14" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-14"><a href="http://demo.themebetter.com/tob/science">研究</a></li>
                <li id="menu-item-11" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-11"><a href="http://demo.themebetter.com/tob/qi">奇异</a></li>
                <li id="menu-item-695" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-695"><a href="http://demo.themebetter.com/tob/page-default">页面</a>
                    <ul class="sub-menu">
                        <li id="menu-item-774" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-774"><a href="http://demo.themebetter.com/tob/page-gallery">页面 相册形式</a></li>
                        <li id="menu-item-773" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-773"><a href="http://demo.themebetter.com/tob/page-image">页面 图像形式</a></li>
                        <li id="menu-item-775" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-775"><a href="http://demo.themebetter.com/tob/page-video">页面 视频形式</a></li>
                    </ul>
                </li>
                <li id="menu-item-694" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-694"><a>页面模板</a>
                    <ul class="sub-menu">
                        <li id="menu-item-193" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-193"><a href="http://demo.themebetter.com/tob/likes">点赞排行</a></li>
                        <li id="menu-item-192" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-192"><a href="http://demo.themebetter.com/tob/week">7天热门</a></li>
                        <li id="menu-item-191" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-191"><a href="http://demo.themebetter.com/tob/month">30天热门</a></li>
                        <li id="menu-item-190" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-190"><a href="http://demo.themebetter.com/tob/tags">热门标签</a></li>
                        <li id="menu-item-687" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-687"><a href="http://demo.themebetter.com/tob/page-blank">空页面</a></li>
                        <li id="menu-item-686" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-686"><a href="http://demo.themebetter.com/tob/page-blank-title">空页面(标题栏)</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <span class=" sitenav-on "><i class="fa fa-bars" aria-hidden="true"></i></span>
        <span class="sitenav-mask"></span>
        <div class="accounts">
            <a class="account-weixin" href="javascript:;"><i class="fa">&#xe60e;</i>
                <div class="account-popover">
                    <div class="account-popover-content">
                        <img src="http://demo.themebetter.com/tob/wp-content/themes/tob/img/qrcode.png">
                    </div>
                </div>
            </a>
            <a class="account-qzone" href="http://demo.themebetter.com/tob" tipsy title="关注QQ空间">
                <i class="fa">&#xe607;</i>

                <div class="account-popover">
                    <div class="account-popover-content">
                        <img src="http://demo.themebetter.com/tob/wp-content/themes/tob/img/qrcode.png">
                    </div>
                </div>
            </a> 
            <a class="account-weibo" href="{{ url('/home/login') }}" tipsy title="登录-了解更多">登录</a>
            <a class="account-tqq" href="{{ url('/home/register') }}" tipsy title="注册-参与其中">注册</a> 
        </div>
        <span class="searchstart-on">
            <a href="{{url('home/login')}}"><i class="fa fa-user fa-fw fa-2x"></i>登录</a>
        </span>
        <span class="searchstart-off"><i class="fa">&#xe606;</i></span>
        <form method="get" class="searchform" action="http://demo.themebetter.com/tob/">
            <button tabindex="3" class="sbtn" type="submit"><i class="fa">&#xe600;</i></button>
            <input tabindex="2" class="sinput" name="s" type="text" placeholder="输入关键字" value="">
        </form>
    </div>
</header>