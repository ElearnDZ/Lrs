<?php namespace Lrs\Tracker\Locker\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\User\UserRepository',
            'Lrs\Tracker\Locker\Repository\User\EloquentUserRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Statement\Repository',
            'Lrs\Tracker\Locker\Repository\Statement\EloquentRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Lrs\Repository',
            'Lrs\Tracker\Locker\Repository\Lrs\EloquentRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Client\Repository',
            'Lrs\Tracker\Locker\Repository\Client\EloquentRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Site\SiteRepository',
            'Lrs\Tracker\Locker\Repository\Site\EloquentSiteRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Query\QueryRepository',
            'Lrs\Tracker\Locker\Repository\Query\EloquentQueryRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Document\DocumentRepository',
            'Lrs\Tracker\Locker\Repository\Document\EloquentDocumentRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\OAuthLrs\Tracker\OAuthLrs\TrackerRepository',
            'Lrs\Tracker\Locker\Repository\OAuthLrs\Tracker\EloquentOAuthLrs\TrackerRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Report\Repository',
            'Lrs\Tracker\Locker\Repository\Report\EloquentRepository'
        );
        $this->Lrs\Tracker->bind(
            'Lrs\Tracker\Locker\Repository\Export\Repository',
            'Lrs\Tracker\Locker\Repository\Export\EloquentRepository'
        );
    }


}
