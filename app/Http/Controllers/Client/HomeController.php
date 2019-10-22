<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Slider;
use Session;
class HomeController extends Controller
{
    public function index()
    {
    	$posts = Post::where('lang_id',Session::get('locale'))->limit(4)->orderBy('id','desc')->get();
    	$sliders = Slider::where('is_active',config('common.active.is_active'))->orderBy('order_number','asc')->get();
    	return view('client.home.index',compact(['posts','sliders']));
    }
}
