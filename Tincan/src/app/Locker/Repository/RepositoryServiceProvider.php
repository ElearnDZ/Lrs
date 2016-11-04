<?php namespace App\Locker\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(
            'App\Locker\Repository\User\UserRepository',
            'App\Locker\Repository\User\EloquentUserRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Statement\Repository',
            'App\Locker\Repository\Statement\EloquentRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Lrs\Repository',
            'App\Locker\Repository\Lrs\EloquentRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Client\Repository',
            'App\Locker\Repository\Client\EloquentRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Site\SiteRepository',
            'App\Locker\Repository\Site\EloquentSiteRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Query\QueryRepository',
            'App\Locker\Repository\Query\EloquentQueryRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Document\DocumentRepository',
            'App\Locker\Repository\Document\EloquentDocumentRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\OAuthApp\OAuthAppRepository',
            'App\Locker\Repository\OAuthApp\EloquentOAuthAppRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Report\Repository',
            'App\Locker\Repository\Report\EloquentRepository'
        );
        $this->app->bind(
            'App\Locker\Repository\Export\Repository',
            'App\Locker\Repository\Export\EloquentRepository'
        );
    }


}
