<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * Execute the command
     *
     * @return \App\Models\User
     */
    public function execute()
    {
        return $this->checkCredentials();
    }

    /**
     * Set request
     *
     * @return self
     */
    public function setRequest(Request $request)
    {
        $this->setUsername($request->input('username'))
            ->setPassword($request->input(['password']));

        return $this;
    }

    /**
     * Check user credentials before login
     *
     * @return \App\Models\User
     */
    protected function checkCredentials()
    {
        $isValid = Auth::attempt([
            'username' => $this->username,
            'password' => $this->password
        ]);

        if (! $isValid) {
            return $isValid;
        }

        $user = User::where('username', $this->username)->first();

        return $user;
    }

    /**
     * Set username attribute
     * @param string $username
     *
     * @return self
     */
    protected function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password attribute
     * @param string $password
     *
     * @return self
     */
    protected function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}