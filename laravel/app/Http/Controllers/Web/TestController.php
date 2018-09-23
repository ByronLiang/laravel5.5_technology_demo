<?php

namespace App\Http\Controllers\Web;

use App\Events\News;

class TestController extends Controller
{
	public function index() 
	{
		// dd('aa');
    	broadcast(new News(date('Y-m-d h:i:s A').": BIG NEWS!"));
    	dd('finish broadcast');
	}
}
