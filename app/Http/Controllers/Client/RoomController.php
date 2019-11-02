<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Room\RoomRepository;
use App\Repositories\RoomName\RoomNameRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    private $roomRepository;
    private $locationRepository;
    private $propertyRepository;
    private $baseLang;
    private $roomNameRepository;

    public function __construct(
        RoomRepository $roomRepository,
        LocationRepository $locationRepository,
        PropertyRepository $propertyRepository,
        RoomNameRepository $roomNameRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->locationRepository = $locationRepository;
        $this->propertyRepository = $propertyRepository;
        $this->roomNameRepository = $roomNameRepository;
        $this->baseLang = config('common.languages.default');
    }

    public function index($location_id)
    {
        $location = $this->locationRepository->findOrFail($location_id);
        $rooms = $this->roomRepository
            ->where('location_id', '=', $location_id)
            ->with([
                'roomName',
                'roomDetails' => function ($q) {
                    $q->where('lang_id', session('locale'));
                },
                'properties'
            ])
            ->whereHas('roomDetails', function ($q) {
                $q->where('lang_id', session('locale'));
            })->paginate(config('common.pagination.default'));
        if (session('locale') != $this->baseLang) {
            foreach ($rooms as $room) {
                $roomNameId = $room->roomName->id;
                $name = $this->roomNameRepository->where('lang_parent_id', '=', $roomNameId)->first();
                if ($name) {
                    $room->name = $name->name;
                }
            }
        }
        $propertyRepository = $this->propertyRepository;
        $data = compact(
            'rooms',
            'location',
            'propertyRepository'
        );

        return view('client.rooms.index', $data);
    }

    public function detail(Request $request, $location_id, $id)
    {
        $room = $this->roomRepository->findOrFail($id);
        $room->load('properties');
        if (session('locale') == $this->baseLang) {
            $name = $room->roomName->name;
        } else {
            $nameId = $room->roomName->id;
            $roomName = $this->roomNameRepository->where('lang_parent_id', '=', $nameId)->first();
            if ($roomName) {
                $name = $roomName->name;
            } else {
                $name = '';
            }
        }
        $roomDetail = $room->roomDetails->where('lang_id', session('locale'))->first();
        if (!$roomDetail) {
            $request->session()->flash('error', 'Chưa có bản dịch của phòng này');
            Session::put('locale', $this->baseLang);

            return redirect(route('rooms.detail', [$location_id, $id]));
        }

        $stars = round((int)$room->rating);
        $whiteStars = 5 - (int)$room->rating;
        if (\session('locale') == $this->baseLang) {
            $properties = $room->properties;
        } else {
            $propertyIds = $room->properties->pluck('id')->toArray();
            $properties = $this->propertyRepository->whereIn('lang_parent_id', $propertyIds)->where('lang_id', \session('locale'))->get();
        }
        $data = compact(
            'room',
            'roomDetail',
            'stars',
            'whiteStars',
            'properties',
            'name'
        );

        return view('client.rooms.detail', $data);
    }
}
