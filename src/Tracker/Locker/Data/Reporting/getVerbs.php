<?php namespace Lrs\Tracker\Locker\Data\Reporting;

class getVerbs
{

    public function __construct()
    {
    }

    public function getVerbs($lrs)
    {
        $verbs = \Statement::where('lrs_id', $lrs)
            ->select('statement.verb')
            ->distinct()
            ->remember(15)
            ->get()->toArray();

        return $verbs;

    }

} 
