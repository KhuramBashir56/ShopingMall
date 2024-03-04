<?php

namespace App\Gates;

use App\Models\User;

class UserGate
{
    public function verified_user_role(User $user)
    {
        return $user->role === 'user';
    }
}