<?php

namespace Iqionly\MansionClient\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController {
    public function __invoke(Request $request)
    {
        Auth::logout();

        $access_token = $request->session()->get('access_token');
        $response = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token
        ])->get(config('mansion.url'). '/api/user');

        $users = $response->json();

        try {
            $email = $users['email'];
        } catch (\Throwable $th) {
            return redirect('/')->withErrors('Failed to get login information! Try again later.');
        }

        $call = config('auth.providers.users.model');
        $user = $call::where(config('mansion.username_column'), $users['name'])->first();

        if (!$user) {
            return redirect('/')->withErrors('Your account could not found in KaryaPres');
        }

        Auth::login($user);

        return redirect()->intended('/');
    }

}