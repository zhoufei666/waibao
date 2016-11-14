<?php

namespace App\Http\Models\admin;

use Illuminate\Database\Eloquent\Model;

class adminModel extends Model
{
    public function __construct()
    {
    	//强制设置时区
    	date_default_timezone_set('PRC');
    }
}
