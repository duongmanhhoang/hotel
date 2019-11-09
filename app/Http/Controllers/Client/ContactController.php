<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ClientContactRequest;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Location\LocationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(ContactRepository $contactRepository, LocationRepository $locationRepository)
    {
        $this->contactRepo = $contactRepository;
        $this->locationRepo = $locationRepository;
    }

    public function index()
    {
        $locations = $this->locationRepo->contactGetLocation();
        $user = Auth::user() ?? null;

        return view('client.contact.index', compact('locations', 'user'));
    }

    public function postContact(ClientContactRequest $request)
    {
        $input = $request->all();

        $this->contactRepo->create($input);

        return redirect()->route('contact.index')->with(['success' => __('messages.contact.post_success')]);
    }
}
