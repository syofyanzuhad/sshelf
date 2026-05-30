<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DesktopLoginController extends Controller
{
    /**
     * Handle the desktop login bridge.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Generate the token
        $token = $user->createToken('Sshelf Desktop')->plainTextToken;

        // 2. Build query parameters
        $params = http_build_query([
            'token' => $token,
            'url' => config('app.url').'/api/v1',
            'reverb_key' => config('reverb.apps.apps.0.key'),
            'reverb_port' => config('reverb.apps.apps.0.options.port'),
        ]);

        // 3. Redirect to the desktop app scheme
        return redirect()->away("sshelf://auth?{$params}");
    }
}
