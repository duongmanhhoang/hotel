<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomDetail\RoomDetailRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Library\LibraryRepository;
use App\Models\RoomDetail;
use App\Models\Room;
use App\Models\Location;
use Session;

class HomeController extends Controller
{
	public function __construct(
        PostRepository $postRepository,       
        LanguageRepository $languageRepository,
        LocationRepository $locationRepository,
        RoomRepository $roomRepository,
        RoomDetailRepository $roomDetailRepository,
        LibraryRepository $libraryRepository
        )
    {
        $this->postRepository = $postRepository;
        $this->languageRepository = $languageRepository;
        $this->locationRepository = $locationRepository;
        $this->roomRepository = $roomRepository;
        $this->roomDetailRepository = $roomDetailRepository;
        $this->libraryRepository = $libraryRepository;
    }


    public function index()
    {
    	$posts = $this->postRepository->limitByLang(Session::get('locale'),4);


    	$saleroom = Room::where('sale_status',config('common.active.is_active'))->with(['roomDetails' => function($query) {
    		$query->where('lang_id',Session::get('locale'));
    	}, 'properties'])->orderBy('id','desc')->first();
    	$libraries = $this->libraryRepository->limit(12);
    	// dd($locations);
    	return view('client.home.index',compact(['posts','libraries','saleroom']));

    }
}
