<?php 

namespace App\Http\Controllers\Api;

use Dingo\Api\Http\Request;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;

use JWTAuth;
use App\User;

class AuthController extends BaseController
{

    public function login(Request $request)
    {

        try {

            if ($request->has('api_token')) {
                $this->validate($request, ['email' => 'required|email', 'remember_token' => 'required']);
                $credentials = $request->only('email', 'remember_token');
            }
            else {
                $this->validate($request, ['email' => 'required|email', 'password' => 'required']);

                $credentials = $request->only('email', 'password');
            }

            // attempt to verify the credentials and create a token for the user
            if (!$token = \JWTAuth::attempt($credentials)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid credentials!'], 401);
            }

            $user = User::whereEmail($credentials['email'])->first();

        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->validator->getMessageBag()->first()], 401);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['status' => 'error', 'message' => 'Could not create token'], 500);
        }

        return response()->json(['status' => 'success', 'token' => $token, 'user' => $user], 200);
    }

    public function refresh()
    {
        $current_token = JWTAuth::getToken();
        $token = JWTAuth::refresh($current_token);

        return response()->json(compact('token'));
    }

    public function logout()
    {
        $current_token = JWTAuth::getToken();
        $token = JWTAuth::invalidate($current_token);

        return response()->json(['status' => 'success', 'message' => 'Token Destroyed'], 401);
    }
}
