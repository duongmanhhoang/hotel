<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\ContactReader\ContactReaderRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(ContactRepository $contactRepository, ContactReaderRepository $contactReaderRepository)
    {
        $this->contactRepo = $contactRepository;
        $this->contactReaderRepo = $contactReaderRepository;
    }

    public function index()
    {
        return view('admin.contact.index');
    }

    public function dataTable()
    {
        $data = $this->contactRepo->getContact();

        return response()->json(['data' => $data]);
    }

    public function detail($id)
    {
        $data = $this->contactRepo->getContactById($id);

        if($data == null) return redirect()->back()->with(['error' => 'Không tìm thấy dữ liệu']);

        $userReader = $this->contactReaderRepo->findUserViaContactId($id);

        if($userReader == null) {
            $this->contactReaderRepo->insertReader($id);
        }

        return view('admin.contact.detail', compact('data'));
    }

    public function delete($id)
    {
        $result = $this->contactRepo->delete($id);

        return response()->json(['status' => !!$result]);
    }
}
