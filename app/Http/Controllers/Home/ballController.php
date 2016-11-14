<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Ball;

class ballController extends Controller
{

    public function getRand()
    {
        $ball = new Ball();

        $id = rand(1,10000000);   

        $data = $ball->getBallByid($id);
        

        print_r($data);
    }

    public function index()
    {
        ini_set('max_execution_time',86400);
        $this->CreateBigData();
        $prize = $this->ChooseOne();

        $ball = new Ball();
        $data = $ball->getBall();
        $index = array_rand($data,1);

        print_r($data[$index]);
    }

    public function CreateBigData(){
        for ($i = 1; $i  < 10000000; $i ++) { 
            $data = $this->createRedBlue();
            $ball = new Ball();
            $ball->saveData($data);
        }
    }
    public function createRedBlue(){
        $red = array();
        $blue = array();
        $Winning['red'] = array();
        $Winning['blue'] = array();

        for ($i=1; $i <= 33 ; $i++) { 
            $red[] = $i;
            if ($i <= 16) {
                $blue[] = $i;
            }
        }

        $data['red'] = array_rand($red,6);
        $data['blue'] = array_rand($blue,1);
        return $data;
    }

    public function ChooseOne()
    {
        $ball = new Ball();
        $data = $ball->getBall();

        return $this->handleData($data);
    }

    public function handleData($data)
    {
        if (count($data) >= 10) {
            $num = ceil(count($data)/10);
            
            $sdata = array_rand($data,$num);
        }else{
            return array_rand($data,1);
        }
    }

}