<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
        return captcha_src($type);
	}

	/**
	 * 检查验证码
	 * @param string $captcha 验证码
	 */
	public function verifyCaptcha(Request $request)
	{
		$captcha_text = $request->input('captcha');
		if ($captcha_text == '') {
			return  false;
		}
		return captcha_check($captcha_text);
	}


}
