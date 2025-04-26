<?php

namespace App\Http\Controllers;

use App\Models\Guest;

class GuestService
{
    public function createGuest(array $data)
    {
        $data['user-agent'] = request()->userAgent(); 

        $guest = Guest::query()->create($data);

        $sessionData = request()->session()->all();

        $guest->token = $sessionData['_token'] ?? \Illuminate\Support\Str::random(40);

        $guest->save();

        return $guest->id;
    }
}
