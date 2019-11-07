<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\RoomName\RoomNameRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomDetail\RoomDetailRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Library\LibraryRepository;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    private $postRepository;
    private $languageRepository;
    private $locationRepository;
    private $roomRepository;
    private $roomDetailRepository;
    private $libraryRepository;
    private $roomNameRepository;
    private $baseLang;

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
        $posts = $this->postRepository->limitByLang(Session::get('locale'), config('common.limit.home_posts'));
        $locationsCount = $this->locationRepository->where('lang_parent_id', '=', 0)->count();
        $locations = $this->locationRepository->where('lang_parent_id', '=', 0)->with(['rooms' => function ($q) use ($locationsCount) {
            $q->limit($locationsCount * 2)->orderBy('id', 'desc');
        }, 'rooms.roomDetails' => function ($q) {
            $q->where('lang_id', session('locale'));
        }, 'rooms.roomName' => function ($q) {
            $q->where('lang_id', session('locale'));
        }])->get();
        $searchLocations = $this->locationRepository->where('lang_id', '=', \session('locale'))->get();
        $libraries = $this->libraryRepository->limit(config('common.limit.gallery'));
        $baseLang = $this->baseLang;
        $roomNameRepository = $this->roomNameRepository;
        $data = compact(
            'locations',
            'posts',
            'libraries',
            'baseLang',
            'roomNameRepository',
            'searchLocations'
        );

    	return view('client.home.index', $data);

    }
}
