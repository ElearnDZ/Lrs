<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
        \App\Http\Middleware\AfterSetHeader::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,

        'oauth' => \LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class,
        'oauth-user' => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
        'oauth-client' => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
        'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
        'auth.statement' => \App\Http\Middleware\AuthenticateStatement::class,
        'registration.status' => \App\Http\Middleware\RegistrationStatusAuthenticete::class,
        'user.delete' => \App\Http\Middleware\UserDelete::class,
        'edit.lrs' => \App\Http\Middleware\EditLRS::class,
        'create.lrs'=>\App\Http\Middleware\CreateLRS::class,
        'auth.lrs'=>\App\Http\Middleware\AuthenticateLRS::class,
        'auth.admin'=>\App\Http\Middleware\AuthenticateAdmin::class,
        'auth.super'=>\App\Http\Middleware\AuthenticateSuper::class,
    ];
}
