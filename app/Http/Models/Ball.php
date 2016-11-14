<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\UserAccount;

use Hash;
use Request;
use Input;
use DB;

class Ball extends homeModel
{
	public function saveData($data)
	{
		DB::table('ball')->insert([
                'red1' => $data['red'][0],
                'red2' => $data['red'][1],
                'red3' => $data['red'][2],
                'red4' => $data['red'][3],
                'red5' => $data['red'][4],
                'red6' => $data['red'][5],
                'blue' => $data['blue']
                ]);
	}

	public function getBall()
	{
		return DB::table('ball')->get();
	}

	public function getBallByid($id)
	{
		return DB::table('ball')->where('id',$id)->get();
	}

}