@extends('Public.Home.common')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/Common/Css/login.css')}}">
@stop

@section('content')
	<div class="content">
		<div class="login">
			<div class="ad">				
				<div class="ad-top"></div>
				<div class="ad-content">
					<!-- <h5>此广告位招商！！！！</h5> -->
					<img src="{{asset('assets/Home/image/beautyful.jpg')}}">
				</div>
				<div class="ad-bottom"></div>
			</div>
			<div class="login-form">
				<div class="area">
					<form action="{{ url('home/login') }}" method="post" class="form-horizontal" validate='true'>
						<div class="login-tip tip-top"><i class="fa fa-user fa-fw fa-2x""></i> <span>登录</span></div>
						{!! csrf_field() !!}

						<div>
							<label for="username" class="login-title">用户名:</label>
							<input type="text" name="email" id="username" class="login-item required  email" title="请输入邮箱号" placeholder="请输入邮箱号">
						</div>
						

						<div>
							<label for="password" class="login-title "  >密  码:</label>
							<input type="password" name="password" id="passwrod" class="login-item  required" minlength="6" placeholder="请输入6位以上密码" title="请正确填写密码">
						</div>


						<div class="remember">
							<input type="checkbox" name="remember" id="remember" class="remember-check remember">
							<label for="remember" class="remember-login remember">保持登录状态</label>
						</div>
						

						<button type="submit" class="login-submit ajax-post" target-form='form-horizontal'> 登录 </button>

						<div class="login-tip-something">
							<div class="forget-password">
								<a href="forgetPassword">忘记密码？戳我</a>
							</div>
							<div class="no-account">
								<a href="register">还没有账号？注册</a>
							</div>
						</div>

						<div class="third-login">
							<div class="third-login-item">
								<img src="{{asset('assets/Common/Image/wechat.png')}}">
								<span>微信登录</span>
							</div>	
							<div class="third-login-item third-login-item-last">
								<img src="{{asset('assets/Common/Image/wechat.png')}}">
								<span>微博登录</span>
							</div>		
						</div>

					</form>
				</div>
			</div>
		</div>			
	</div>
@stop
@section('script')
	<link rel="stylesheet" type="text/css" href="{{asset('assets/Common/validate/validate.css')}}">
	<!-- <script type="text/javascript" src="{{asset('assets/Common/validate/jquery-validate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/Common/validate/validate.message.js')}}"></script -->

	<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/jquery-validate/1.14.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{asset('assets/Common/validate/ajax.js')}}"></script>
@stop