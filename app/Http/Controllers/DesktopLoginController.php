<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class DesktopLoginController extends Controller
{
    /**
     * Handle the desktop login bridge.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        // 1. Generate the token
        $token = $user->createToken('Sshelf Desktop')->plainTextToken;

        // 2. Build configuration data
        $config = [
            'token' => $token,
            'url' => config('app.url').'/api/v1',
            'reverb_key' => config('reverb.apps.apps.0.key'),
            'reverb_port' => (string) config('reverb.apps.apps.0.options.port'),
        ];

        // 3. Build the deep link URL
        $deeplink = "sshelf://auth?".http_build_query($config);

        return view('auth.desktop-bridge', [
            'deeplink' => $deeplink,
            'config' => $config,
        ]);
    }
}
