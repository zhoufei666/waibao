<?php

namespace App\Http\Models\admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class adminModel extends Model
{
    public function __construct()
    {
    	//强制设置时区
    	date_default_timezone_set('PRC');

    	//开发阶段：是否开启打印sql模式（正式部署时请关闭）
    	if (env('DEVELOPMENT')) {
    		DB::connection()->enableQueryLog();
    		//这种模式下，可以在任何地方打印SQL，如：print_r(DB::getQueryLog());die;
    	}
    }
}
