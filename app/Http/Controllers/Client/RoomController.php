<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\Room\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $roomRepository;
    private $locationRepository;
    private $propertyRepository;

    public function __construct(
        RoomRepository $roomRepository,
        LocationRepository $locationRepository,
        PropertyRepository $propertyRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->locationRepository = $locationRepository;
        $this->propertyRepository = $propertyRepository;
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
        $propertyRepository = $this->propertyRepository;
        $data = compact(
            'rooms',
            'location',
            'propertyRepository'
        );

        return view('client.rooms.index', $data);
    }

    public function detail($location_id, $id)
    {
        $room = $this->roomRepository->findOrFail($id);
        $roomDetail = $room->roomDetails->where('lang_id', session('locale'))->first();
        $stars = round((int)$room->rating);
        $whiteStars = 5 - (int)$room->rating;
        $properties = $room->properties()->where('lang_id', session('locale'))->get();
        $data = compact(
            'room',
            'roomDetail',
            'stars',
            'whiteStars',
            'properties'
        );

        return view('client.rooms.detail', $data);
    }
}
