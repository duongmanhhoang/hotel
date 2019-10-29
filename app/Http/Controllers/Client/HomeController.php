<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RoomName;
use App\Repositories\RoomName\RoomNameRepository;
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
    public function __construct
    (
        PostRepository $postRepository,
        LanguageRepository $languageRepository,
        LocationRepository $locationRepository,
        RoomRepository $roomRepository,
        RoomDetailRepository $roomDetailRepository,
        LibraryRepository $libraryRepository,
        RoomNameRepository $roomNameRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->languageRepository = $languageRepository;
        $this->locationRepository = $locationRepository;
        $this->roomRepository = $roomRepository;
        $this->roomDetailRepository = $roomDetailRepository;
        $this->libraryRepository = $libraryRepository;
        $this->roomNameRepository = $roomNameRepository;
        $this->baseLang = config('common.languages.default');
    }


    public function index()
    {
        $posts = $this->postRepository->limitByLang(Session::get('locale'), 4);
        $locationsCount = $this->locationRepository->where('lang_parent_id', '=', 0)->count();
        $locations = $this->locationRepository->where('lang_parent_id', '=', 0)->with(['rooms' => function ($q) use ($locationsCount) {
            $q->limit($locationsCount * 2)->orderBy('id', 'desc');
        }, 'rooms.roomDetails' => function ($q) {
            $q->where('lang_id', session('locale'));
        }, 'rooms.roomName' => function ($q) {
            $q->where('lang_id', session('locale'));
        }])->get();
        $libraries = $this->libraryRepository->limit(12);
        $baseLang = $this->baseLang;
        $roomNameRepository = $this->roomNameRepository;
        $data = compact(
            'locations',
            'posts',
            'libraries',
            'baseLang',
            'roomNameRepository'
        );

    	return view('client.home.index', $data);

    }
}
