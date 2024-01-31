<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return inertia('Login');
    }
}
