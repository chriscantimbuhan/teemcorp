<?php

namespace App\Http\Controllers\API;

use App\Actions\User\StoreOrUpdateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(UserRequest $request)
    {
        $user = (new StoreOrUpdateUser)
            ->setRequest($request)
            ->execute();
        
        return response()->json(new UserResource($user), 200);
    }
}
