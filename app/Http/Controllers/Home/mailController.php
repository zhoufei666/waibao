<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;

class mailController extends Controller
{
    public function send()
    {
        $name = '你好啊';

		$flag = Mail::raw('哈哈哈，老婆，我爱你哟', function ($message) {
		    $to = '894481778@qq.com';
		    $message ->to($to)->subject('老婆，我爱你');
		});
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}
