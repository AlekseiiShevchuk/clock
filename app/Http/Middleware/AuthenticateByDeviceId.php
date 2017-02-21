<?php

namespace App\Http\Middleware;

use App\Player;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthenticateByDeviceId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($device_id = $request->header('device_id')) {
            $player = Player::firstOrCreate(['device_id' => $device_id],
                ['device_id' => $device_id, 'nickname' => 'not_filled']);
            $player = Player::findOrFail($player->id);
            Auth::login($player);
        }else{
            throw new BadRequestHttpException('you should send "device-id" in your request headers');
        }
        return $next($request);
    }
}
