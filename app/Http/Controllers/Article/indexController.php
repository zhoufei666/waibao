<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;

class indexController extends Controller
{
	/**
	 * 文章展示页
	 * @param  int $id 文章id
	 * @return array     文章信息
	 */
    public function index($id = '')
    {
    	if (empty($id)) {
    		return Redirect::to('/');
    	}
    	return view('Article.index');
    }
}
