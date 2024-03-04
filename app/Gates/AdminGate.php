<?php

namespace App\Gates;

use App\Models\User;

class AdminGate
{
    public function verified_admin_role(User $user)
    {
        return $user->role === 'admin';
    }
}