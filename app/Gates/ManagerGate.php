<?php

namespace App\Gates;

use App\Models\User;

class ManagerGate
{
    public function verified_manager_role(User $user)
    {
        return $user->role === 'manager';
    }
}