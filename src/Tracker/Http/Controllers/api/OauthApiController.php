<?php

namespace Lrs\Tracker\Http\Controllers\API;

use Authorizer;
use Lrs\Tracker\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OauthApiController extends Controller
{
    private $response;

    private $request;


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getAccessToken()
    {
        $response = response()->json(Authorizer::issueAccessToken());
        return $response;
    }
}
