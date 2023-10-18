<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieUpdateRequest;
use App\Http\Requests\SessionStoreRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Models\Movie;
use App\Models\Session;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

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
    public function indexView() : View
    {
        return $this->sessionService->indexView();
    }

    /**
     * @param Session $session
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showView(Session $session) : View
    {
        return $this->sessionService->showView($session);
    }

    /**
     * @param SessionStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function store(SessionStoreRequest $request) : View
    {
        return $this->sessionService->store($request->validated());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function storeView() : View
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
     */
    public function update(Session $session,SessionUpdateRequest $request) : View
    {
        return $this->sessionService->update($session,$request->validated());
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
