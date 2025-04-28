<?php

namespace App\Http\Controllers;

use App\Models\Guest;

class GuestService
{
    public function createGuest(array $data)
    {
        $data['user-agent'] = request()->userAgent(); 
        $data['ip'] = request()->ip();

        $guest = Guest::query()->create($data);

        $sessionData = request()->session()->all();

        $guest->token = $sessionData['_token'] ?? \Illuminate\Support\Str::random(40);

        $guest->save();

        return $guest->id;
    }

    public function obtenerInvitado($id)
    {
        $guest = Guest::query()->findOrFail($id)->select('id', 'status_id')->first();

        return $guest;
    }
}
