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
    /**
     * @var SessionService
     */
    protected SessionService $sessionService;

    /**
     * SessionController constructor.
     * @param SessionService $sessionService
     */
    public function __construct(
        SessionService $sessionService,
    )
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Session::all();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function indexView()
    {
        return $this->sessionService->indexView();
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Session $session)
    {
        return $this->sessionService->showView($session);
    }

    /**
     * @param SessionStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(SessionStoreRequest $request)
    {
        return $this->sessionService->store($request->validated());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView()
    {
        return $this->sessionService->storeView();
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function updateView(Session $session)
    {
        return $this->sessionService->updateView($session);
    }

    /**
     * @param Session $session
     * @param MovieUpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function update(Session $session,MovieUpdateRequest $request){
        $data = $request->validated();
        $data = array_filter($data, function ($value) {
            return !is_null($value) && $value !== '';
        });
        $session->fill($data);
        $session->save();

        return view('admin.sessions.show',compact('session'));
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function destroy(Session $session)
    {
        return $this->sessionService->destroy($session);
    }
}
