<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (or specify an array of IPs/CIDRs).
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * Use all of the forwarded headers (X-Forwarded-For, X-Forwarded-Proto, etc.).
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
