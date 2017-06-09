<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Illuminate\Support\Facades\Storage;

class mailController extends Controller
{
    public function send()
    {
        //纯文本测试OK
//		$flag = Mail::raw('哈哈哈，你哟', function ($message) {
//		    $to = '1784129344@qq.com';
//		    $message ->to($to)->subject('GGGGGGG');
//		});

        //模板文件方式OK
//        $flag = Mail::send('emails.register',['register_password'=>123456],function($message){
//            $to = '1784129344@qq.com';
//            $message ->to($to)->subject('邮件测试');
//        });
        $flag = $this->email('1784129344@qq.com','',['你的密码是多少？'],'测试');

        //群发模式
//        $email = array('596740325@qq.com','1784129344@qq.com');
//        $flag = 1;
//        $body = '邮件测试内容';
//        foreach ($email as $item) {
//            $flag = Mail::send('emails.register',['register_password'=>123456],function($message)  use($item,$body) {
//                $message ->to($item)->subject('邮件测试');
//            });
//            if (!$flag){
//                $flag = 0;
//                break;
//            }
//        }

//        邮件中发送网络附件ok
//        $image = 'http://d.hiphotos.baidu.com/zhidao/pic/item/1ad5ad6eddc451da4ab93e2bb0fd5266d11632a6.jpg';
//        $flag = Mail::send('emails.test',['imgPath'=>$image],function($message){
//            $to = '1784129344@qq.com';
//            $message ->to($to)->subject('网络图片测试');
//        });

//        邮件中发送本地图片附件 fail
//        $local_imgPath = storage_path('images/obama.jpg');
//        $flag = Mail::send('emails.test',['local_imgPath'=>$local_imgPath],function($message) use($local_imgPath){
//            $to = '1784129344@qq.com';
//            $message->to($to)->subject('[本地图片测试]');
//            $message->attach($local_imgPath);
//        });

//        在邮件中上传附件ok
//        set_time_limit(0);
//        $flag = Mail::send('emails.test',['name'=>123],function($message){
//            $to = '1784129344@qq.com';
//            $message->to($to)->subject('邮件主题');
//            $attachment = storage_path('files\test.txt');
//            // 在邮件中上传附件
//            $message->attach($attachment,['as'=>"=?UTF-8?B?".base64_encode('中文文档')."?=.txt"]);
//        });


        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }

    /**
     * 发送邮件
     * @param string $email 邮箱号
     * @param string $body 正文
     * @param string $theme 邮件主题
     * @param int    $type 发送邮件类型：用于选择模板
     */
    public function send_email($email = '',$theme = '', $body = '',$type = 1)
    {
        switch ($type){
            case 1:
                //注册成功发送通知邮件
                $email_type = 'emails.register';

                break;
            default:
                break;
        }
        $this->email($email,$email_type,$body,$theme);

    }

    /**
     * 具体执行发送邮件
     * @param string $email_to 发送对象
     * @param array $type 选择好的邮件模板
     * @param array $data 发送的数据
     * @param string $theme 邮件的主题
     */
    protected function email($email_to = '', $type = '',$data = [],$theme = '')
    {
        set_time_limit(0);
        if ($type){
            if (is_array($email_to)){
                foreach ($email_to as $item){
                    $this->email($item,$type,$data,$theme);
                }
            }else{
                Mail::send($type,$data,function($message) use($email_to,$theme){
                    $message ->to('1784129344@qq.com')->subject($theme);
                });
            }
        }else{
            if (is_array($email_to)){
                foreach ($email_to as $item){
                    $this->email($item,$type,$data,$theme);
                }
            }else{
                if (is_array($data)){
                    $data = implode(',',$data);
                }
                Mail::raw($data, function ($message) use($email_to,$theme) {
                    $message ->to($email_to)->subject($theme);
                });
            }
        }
    }

}
