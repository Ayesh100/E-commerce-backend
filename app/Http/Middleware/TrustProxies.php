<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware; // or use // Symfony\Component\HttpFoundation\Request; depending on your Laravel version

class TrustProxies extends Middleware
{
    /**
     * Set this to '*' so all proxies are trusted.
     * Or put your proxy IPs here if you prefer.
     */
    protected $proxies = '*';

    /**
     * Ensure Laravel uses all forwarded headers, including X-Forwarded-Proto.
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
