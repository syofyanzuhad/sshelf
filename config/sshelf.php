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
];
