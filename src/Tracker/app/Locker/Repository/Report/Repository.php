<?php namespace App\Locker\Repository\Report;

interface Repository extends \App\Locker\Repository\Base\Repository
{
    public function setQuery($lrs, $query, $field, $wheres);

    public function statements($id, array $opts);
}