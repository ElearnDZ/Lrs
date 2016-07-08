<?php

namespace App\Http\Middleware;

use App\Locker\Helpers\Helpers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Locker\Statements\xAPIValidation;
use App\Locker\Helpers\Exceptions;
use League\OAuth2\Server\Exception\OAuthException;
use League\OAuth2\Server\ResourceServer;

class AuthenticateStatement
{


    /**
     * @param ResourceServer $server
     * @return void
     */
    public function __construct(ResourceServer $server)
    {
        $this->server = $server;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $method = $request->getMethod();

        if ($method !== "OPTIONS") {

            // Validates authorization header.
            $auth_validator = new xAPIValidation();
            $authorization = \LockerRequest::header('Authorization');
            if ($authorization !== null && strpos($authorization, 'Basic') === 0) {
                $authorization = gettype($authorization) === 'string' ? substr($authorization, 6) : false;
                $auth_validator->checkTypes('auth', $authorization, 'base64', 'headers');

                if ($auth_validator->getStatus() === 'failed') {
                    throw new Exceptions\Validation($auth_validator->getErrors());
                }
            } else if ($authorization !== null && strpos($authorization, 'Bearer') === 0) {
                try {
                    $this->server->isValidRequest();
                }catch (OAuthException $e) {
                    throw new Exceptions\Exception('Unauthorized request.', 401);
                }
            } else if ($authorization === null) {
                throw new Exceptions\Exception('Unauthorized request.', 401);
            }

            $lrs = Helpers::getLrsFromAuth();

            //attempt login once
            if (!\Auth::onceUsingId($lrs->owner_id)) {
                throw new Exceptions\Exception('Unauthorized request.', 401);
            }

            return $next($request);

        }
    }
}
