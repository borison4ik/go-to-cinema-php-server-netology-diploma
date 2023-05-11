<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

    protected $except = [
        'stripe/*',
        'localhost:3000/*',
        'localhost:3000/login',
        'localhost:8000/api/admin/login',
        'localhost:8000/admin/auth'
    ];
}
