<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class BaseController extends Controller
{
    use Helpers;

    const LIMIT = 10;
    protected $res = [];

    public function __construct(){
    }

    public function getAuthUser()
    {
        try {
            if (!$user = \JWTAuth::parseToken()->authenticate()) {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['status' => 'error', 'message' => 'Token has expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['status' => 'error', 'message' => 'Invalid token'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['status' => 'error', 'message' => 'Authorization token is absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return $user;
    }

    /**
     * set response
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    protected function setResponse($key,$value)
    {
        return $this->res[$key] = $value;
    }

    /**
     * get response
     * @return [type] [description]
     */
    protected function getResponse()
    {
        return $this->res;
    }
}
