<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sshelf Mode
    |--------------------------------------------------------------------------
    |
    | Supported: "selfhost", "saas"
    |
    | In "selfhost" mode, the application uses a simple RBAC where admins
    | can manage everything.
    |
    | In "saas" mode, the application uses a team-based RBAC where each
    | user has their own space and can invite others.
    |
    */

    'mode' => env('SSHELF_MODE', 'selfhost'),

    /*
    |--------------------------------------------------------------------------
    | SaaS Plans & Limits
    |--------------------------------------------------------------------------
    */

    'plans' => [
        'free' => [
            'limits' => [
                'servers' => 3,
                'ssh_keys' => 1,
                'members' => 0,
            ],
        ],
        'pro' => [
            'limits' => [
                'servers' => 20,
                'ssh_keys' => 5,
                'members' => 2, // Up to 3 total (Owner + 2)
            ],
        ],
        'business' => [
            'limits' => [
                'servers' => -1, // Unlimited
                'ssh_keys' => -1,
                'members' => -1,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Terminal Engine Proxy
    |--------------------------------------------------------------------------
    |
    | When running on Laravel Cloud, you can proxy the background SSH worker
    | to a self-hosted VPS.
    |
    */

    'engine' => [
        'mode' => env('SSHELF_ENGINE_MODE', 'local'), // 'local' or 'proxy'
        'proxy_url' => env('SSHELF_ENGINE_PROXY_URL'), // e.g. https://your-vps.com/api/worker/spawn-terminal
        'internal_token' => env('SSHELF_INTERNAL_TOKEN'),
    ],

    'internal_token' => env('SSHELF_INTERNAL_TOKEN'),
];
