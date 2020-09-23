<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientUser;

class GetClientAdminInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = Auth::user()->id;
        $client_user = ClientUser::where('user_id', $user_id)->first();
        $client_id = $client_user->client_id;
        Auth::user()->client_id = $client_id;
        return $next($request);
    }
}
