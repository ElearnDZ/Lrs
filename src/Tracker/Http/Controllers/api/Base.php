<?php 

namespace Lrs\Tracker\Http\Controllers\API;

use \Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use \Response as IlluminateResponse;
use \LockerRequest as LockerRequest;
use \Config as Config;
use \Route as Route;
use \DB as DB;
use Lrs\Tracker\Locker\Repository\Lrs\EloquentRepository as LrsRepository;
use Lrs\Tracker\Locker\Helpers\Helpers as Helpers;


class Base extends Controller
{

    /**
     * Constructs a new base controller.
     */
    public function __construct()
    {
        $this->lrs = Helpers::getLrsFromAuth();
        list($username, $password) = Helpers::getUserPassFromAuth();
        $this->client = Helpers::getClient($username, $password);
    }

    /**
     * Gets the options from the request.
     * @return [String => Mixed]
     */
    protected function getOptions()
    {
        return [
            'lrs_id' => new \MongoDB\BSON\ObjectID($this->lrs->_id),
            'scopes' => $this->client->scopes,
            'client' => $this->client
        ];
    }

    protected function returnJson($data)
    {
        $params = LockerRequest::getParams();
        if (LockerRequest::hasParam('filter')) {
            $params['filter'] = json_decode(LockerRequest::getParam('filter'));
        }

        return IlluminateResponse::json([
            'version' => Config::get('api.using_version'),
            'route' => Request::path(),
            'url_params' => Route::getCurrentRoute()->parameters(),
            'params' => $params,
            'data' => $data,
            'debug' => !Config::get('app.debug') ? trans('api.info.trace') : DB::getQueryLog()
        ]);
    }
}
