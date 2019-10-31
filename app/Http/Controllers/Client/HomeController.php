<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Room;
use App\Models\RoomDetail;
use Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
    	$posts = Post::where('lang_id',Session::get('locale'))->limit(4)->orderBy('id','desc')->get();
    	$rooms = RoomDetail::all();  
    	// $rooms = RoomDetail::where('lang_id',Session::get('locale'))->get();
    	// dd($rooms);
    	return view('client.contact.index',compact('posts'));

    }
}
