<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Facebook extends Controller {

    public function authorizeInstagram()
    {
        return redirect()->to('https://api.instagram.com/oauth/authorize?client_id=3485917641634543&client_secret=e90c50dbcdeba6ee7499ce4bd523eebd&scope=user_profile,user_media&response_type=code&redirect_uri=' . config('app.url') . '/auth/instagram/cb');
    }

    public function authorizeFacebook()
    {
        return redirect()->to('https://api.instagram.com/oauth/authorize?client_id=3485917641634543&client_secret=e90c50dbcdeba6ee7499ce4bd523eebd&scope=user_profile,user_media&response_type=code&redirect_uri=' . config('app.url') . '/auth/instagram/cb');
    }

    public function instagramCallback(Request $request)
    {
        $code = $request->code;

        $response = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => '3485917641634543',
            'client_secret' => 'e90c50dbcdeba6ee7499ce4bd523eebd',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'https://signetcafe.local.com/auth/instagram/cb',
            'code' => $code,
        ]);

        echo $code;

        dd($response->json());
    }

    public function shareImage(Request $request)
    {
//        dd($request->get('imgSrc'));
        $imgSrc = $request->get('imgSrc');

//        $response = Http::get('https://graph.instagram.com/v12.0/17841448973146036/media?access_token=IGQVJVM2xhV1pEVDM4emlKQ1B0NDBOalFjTkd4RkktR0ZA4STg0a01uQ1lKY3A0ZAGg4UzJMaE52LXR1dTRwTzVKd3R5VDA4UjhBTTF2WFZAvdmZAqLURsUFM3RjBLZAzZAiTU50ejNVR0dXbHNQVmtTXzEycGc5Uk1ZAT1ZA1eEpv');
//
//        dd($response->json());

        if (!empty($imgSrc)) {
            $response = Http::asForm()->post('https://graph.instagram.com/v12.0/17841448973146036/media', [
                'image_url' => $imgSrc,
                'caption' => '#astar',
                'access_token' => "IGQVJVM2xhV1pEVDM4emlKQ1B0NDBOalFjTkd4RkktR0ZA4STg0a01uQ1lKY3A0ZAGg4UzJMaE52LXR1dTRwTzVKd3R5VDA4UjhBTTF2WFZAvdmZAqLURsUFM3RjBLZAzZAiTU50ejNVR0dXbHNQVmtTXzEycGc5Uk1ZAT1ZA1eEpv"
            ]);

            dd($response->json());
        }
    }

    public function facebookCallback(Request $request)
    {
        dd($request->all());
    }
}
