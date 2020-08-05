<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function attemptLogin(array $data)
    {
        return Auth::attempt($data);
    }
}