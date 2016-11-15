<?php namespace App\Locker\Repository\Client;

interface Repository extends \App\Locker\Repository\Base\Repository
{
    public function showFromUserPass($username, $password, array $opts);
}