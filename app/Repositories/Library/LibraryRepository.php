<?php

namespace App\Repositories\Library;

use App\Models\Library;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Config;

class LibraryRepository extends EloquentRepository
{
    public function getModel()
    {
        return Library::class;
    }

    public function getImagesByRoom($roomId)
    {
        return $this->_model->where('room_id', $roomId)->orderBy('id', 'desc')->get();
    }

    public function uploadImage($request, $id)
    {
        $image = $request->file('file');
        $imageName = uploadImage('libraries', $image, true);
        $data['room_id'] = $id;
        $data['name'] = $imageName;
        $this->_model->create($data);

        $request->session()->flash('image_active');

        return response()->json(['success' => $imageName]);
    }

    public function destroyImage($request)
    {
        $filename = $request->get('filename');
        $this->_model->where('name', $filename)->delete();
        $path = Config::get('common.uploads.libraries') . '/' . $filename;
        if (file_exists(public_path() . $path)) {
            unlink(public_path() . $path);
        }
    }

    public function getImageByRoom($room_id)
    {
        return $this->_model->where('room_id', $room_id)->orderBy('id', 'desc')->get();
    }

    public function deleteImage($id)
    {
        $image = $this->_model->findOrFail($id);
        $name = $image->name;
        $image->delete();
        $path = Config::get('common.uploads.libraries') . '/' . $name;
        if (file_exists(public_path() . $path)) {
            unlink(public_path() . $path);
        }
    }
}
