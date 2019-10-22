<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Room\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepsitory = $roomRepository;
    }

    public function index()
    {
        $rooms = $this->roomRepsitory->paginate(config('common.pagination.default'));
        $data = compact(
            'rooms'
        );

        return view('client.rooms.index', $data);
    }

    public function detail($id)
    {
        $room = $this->roomRepsitory->findOrFail($id);
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
