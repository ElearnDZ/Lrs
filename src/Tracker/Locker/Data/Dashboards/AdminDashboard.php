<?php namespace Lrs\Tracker\Locker\Data\Dashboards;

use Lrs\Tracker\Models\Lrs;
use Lrs\Tracker\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends BaseDashboard
{

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user(); //we might want to pass user in, for example when use the API
    }

    /**
     * Set all stats array.
     *
     **/
    public function getFullStats()
    {
        $data = $this->getStats();
        return array_merge(
            $data,
            [
                'lrs_count' => $this->lrsCount(),
                'user_count' => $this->userCount(),
            ]
        );
    }

    /**
     * Count all LRSs in Learning Locker
     *
     * @return count
     *
     **/
    public function lrsCount()
    {
        return Lrs::count();
        //return DB::collection('lrs')->remember(5)->count();
    }

    /**
     * Count the number of users in Learning Locker.
     *
     * @return count.
     *
     **/
    public function userCount()
    {
        return User::count();
        //return DB::collection('users')->remember(5)->count();
    }

}
