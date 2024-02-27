<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class LimitTicketCreation
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $tickets = $user->tickets()->whereDate('created_at', $today)->count();

        if ($tickets >= 5) {
            return response()->json(['message' => 'Вы превысили лимит в 5 тикетов за сутки'], 429);
        }

        return $next($request);
    }
}
