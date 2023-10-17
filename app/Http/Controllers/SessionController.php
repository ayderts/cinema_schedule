<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieUpdateRequest;
use App\Http\Requests\SessionStoreRequest;
use App\Models\Movie;
use App\Models\Session;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected SessionService $sessionService;

    public function __construct(
        SessionService $sessionService,
    )
    {
        $this->sessionService = $sessionService;
    }

    public function index()
    {
        return Session::all();
    }

    public function indexView()
    {
        return $this->sessionService->indexView();
    }

    public function showView(Session $session)
    {
        return $this->sessionService->showView($session);
    }

    public function store(SessionStoreRequest $request)
    {
        return $this->sessionService->store($request->validated());
    }

    public function storeView()
    {
        return $this->sessionService->storeView();
    }

    public function updateView(Session $session)
    {
        return $this->sessionService->updateView($session);
    }

    public function update(Session $session,MovieUpdateRequest $request){
        $data = $request->validated();
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });
        $session->fill($data);
        $session->save();

        return view('admin.sessions.show',compact('session'));
    }

    public function destroy(Session $session)
    {
        return $this->sessionService->destroy($session);
    }
}
