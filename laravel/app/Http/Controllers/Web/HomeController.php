<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Redis;
use Cache;
use App\Models\Catagory;
use App\Models\{Banner, Author};

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', 1)->get();
        $author = Author::with('room')->limit(6)->get();

        return \Response::success(compact('banner', 'author', 'index'));
    }

    public function test()
    {
    	$options = Redis::lrange('options', 0, -1);
   		dd($options);
        $values = Redis::get('name');
        dd($values, Redis::get('age'), Redis::get('gender'));
    	dd('hello world');
    }

    public function cacheOption()
    {
    	$a = Cache::tags(['artists']);
    	dd($a);
    	// $data = Catagory::select('id', 'name')->get()->toJson();
    	// Cache::tags(['artists'])->put('sort', $data, 2);
    	// // dd($data);
    	// if (Cache::has('catagory')) {
    	// 	$catagory = Cache::get('catagory');
    	// 	$catagory = json_decode($catagory, true);
    	// 	dd($catagory);
    	// } else {
    	// 	Cache::forever('catagory', $data);
    	// 	// Cache::put('name', 'byron', 2);
    	// }
    	dd('success');
    }
}
