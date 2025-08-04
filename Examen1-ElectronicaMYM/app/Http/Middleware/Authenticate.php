<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class Authenticate
{
    protected $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $this->authenticate($request, $guards);
        return $next($request);
    }

    protected function authenticate(Request $request, array $guards): void
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
                return;
            }
        }

        throw new AuthenticationException(
            'Unauthenticated.', 
            $guards,
            $this->redirectTo($request)
        );
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}