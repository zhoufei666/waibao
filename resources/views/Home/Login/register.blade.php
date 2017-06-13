@extends('Public.Home.common')

@section('css')
	<!-- 手机端样式 -->

   	<!-- 小屏幕 -->
	<link rel="stylesheet" media="screen and (min-width:300px) and (max-device-width:800px)" href="{{asset('assets/Common/Css/register_min.css')}}"/>


   	<!-- 手机端样式 -->
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
					<form action="{{ url('home/register') }}" method="post" class="form-horizontal" validate='true'>
						<div class="login-tip tip-top"><i class="fa fa-user fa-fw fa-2x""></i> <span>注册</span></div>
						{!! csrf_field() !!}
						<div>
							<label for="username" class="login-title">用户名:</label>
							<input type="text" name="email" id="username" class="login-item required  email" title="请输入邮箱号" placeholder="请输入邮箱号">
						</div>
						

						<div>
							<label for="password" class="login-title "  >密  码:</label>
							<input type="password" name="password" id="passwrod" class="login-item  required" minlength="6" placeholder="请输入6位以上密码" title="请正确填写密码">
						</div>

						<div>
							<label for="invite_number" class="login-title "  >邀请码(选填):</label>
							<input type="invite_number" name="invite_code" id="passwrod" class="login-item  " minlength="6" placeholder="请输入邀请码 - 拥有更多特权">
						</div>

						<div>
							<label for="invite_number" class="login-title "  >验证码:</label>
							<input type="verify_code" name="verify_code" id="verify_code" class="login-item login-item-half   placeholder="请输入验证码">
							<img src="{!! captcha_src()!!}" class="verify_img" alt="" onclick="this.src='{!! captcha_src()!!}'+'&'+Math.random()">
							
						</div>


						<div class="remember">
							<input type="checkbox" name="login_in" value="1"  id="remember" class="remember-check remember">
							<label for="remember" class="remember-login remember">注册成功立即登录</label>
						</div>

						<div class="remember">
						@if (count($errors) > 0)
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						</div>
						

						<button type="submit" class="login-submit ajax-post" target-form='form-horizontal'> 同意协议并注册 </button>

						<div class="login-tip-something">
							<div class="forget-password">
								<a href="">飞毛腿-摄影 协议</a>
							</div>
							<div class="no-account">
								<a href="login">已有账号？登录</a>
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