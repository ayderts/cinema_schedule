<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $prevSession = Session::where('date_time', '<=', $request->date_time)
            ->orderByDesc('date_time')
            ->first();
        $nextSession = Session::where('date_time', '>=', $request->date_time)
            ->orderBy('date_time')
            ->first();

            if ($prevSession) {
                $minTime = Carbon::parse($prevSession->date_time)->addMinutes(30);

                if (Carbon::parse($request->date_time) < $minTime) {
                    return redirect()->back()->withErrors('Время между сеансами должно быть не менее 30 минут');
                }
            }

            if ($nextSession) {
                $minTime = Carbon::parse($nextSession->date_time)->subMinutes(30);

                if (Carbon::parse($request->date_time) > $minTime) {
                    return redirect()->back()->withErrors('Время между сеансами должно быть не менее 30 минут');
                }
            }

        return $next($request);
    }
}
