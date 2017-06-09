<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;

class CaptchaController extends Controller {
	/**
	 * 获取验证码的html
	 */
	public function getCaptchaImg(Request $request)
	{
		$type = $request->get('imgType','default');
        return captcha_img($type);
	}

	/**
	 * 获取验证码的src
	 */
	public function getCaptchaSrc(Request $request)
	{
		$type = $request->get('imgType','default');	
		$src = captcha_src($type);
        return $src;
	}

	/**
	 * 检查验证码
	 * @param string $captcha 验证码
	 */
	public function verifyCaptcha($captcha_text = '')
	{
		if ($captcha_text == '') {
			return  false;
		}

        return captcha_check($captcha_text);
	}


}
