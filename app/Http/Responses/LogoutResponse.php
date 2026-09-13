<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as KontrakLogoutResponse;

class LogoutResponse implements KontrakLogoutResponse
{
    public function toResponse($request)
    {
        return redirect()->route('login');
    }
}