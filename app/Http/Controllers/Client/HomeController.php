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
    	// $locations = $this->locationRepository->getAllByLang(Session::get('locale'));
    	// $rooms = $locations->rooms()->orderBy('id', 'desc');
    	// $locations = Location::where('lang_id',Session::get('locale'))->get();
    	// foreach ( $locations as $location ) {
    	// 	$roomByLocations[] = Room::where('location_id', $location->id)->limit(2)->with('roomDetails')->orderBy('id','desc')->get();
    	// }
    	// $rooms = Location::rooms()->limit(2)->get();
    	// dd($locations);


    	// $Location::find(2);
    	// dd($location);
    	// $locations = Location::with(['rooms' => function ($q) {
     //        $q->limit(2);
     //    }, 'rooms.roomDetails' => function ($q) {
     //        $q->where('lang_id', session('locale'));
     //    }])->get()->toArray();


    	$saleroom = Room::where('sale_status',config('common.active.is_active'))->with(['roomDetails' => function($query) {
    		$query->where('lang_id',Session::get('locale'));
    	}, 'properties'])->orderBy('id','desc')->first();
    	// dd($saleroom);
    	$libraries = $this->libraryRepository->limit(12);
    	// dd($locations);
    	return view('client.home.index',compact(['posts','libraries','saleroom']));

    }
}
