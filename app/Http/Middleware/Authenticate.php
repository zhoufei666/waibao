<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use App\Http\Controllers\Admin\AdminController;
use Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //获取当前的控制器和方法
        $admin = new AdminController();
        $currentActin = $admin->getCurrentAction();

        if (strstr($currentActin['controller'],'Admin')){

            //后台
            $except_action = array('handleLgoin','login','loginout');//不需要验证登录的控制器
            if ( !in_array( $currentActin['method'],$except_action) ){
                // 判断用户是否登录--未登陆跳转页面
                $uid = $admin->isLogin();
                if ($uid === false) {
                    return redirect('admin/login');
                }
            }

        }

        return $next($request);
    }

}
