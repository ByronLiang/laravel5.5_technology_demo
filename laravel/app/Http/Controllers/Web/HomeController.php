<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index()
    {
    	$options = Redis::lrange('options', 0, -1);
   		dd($options);
        $values = Redis::get('name');
        dd($values, Redis::get('age'), Redis::get('gender'));
    	dd('hello world');
    }
}
