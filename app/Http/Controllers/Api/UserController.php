<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Transformers\UserTransformer;
use App\User;

class UserController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function index(Request $request)
    {

        $q = $this->user->newQuery();
        $users = $q->paginate($request->input('limit', 100));
        $users->appends($request->all());
        return $this->response->paginator($users, new UserTransformer());
    }
}
