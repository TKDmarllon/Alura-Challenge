<?php

namespace App\Repository;

use App\Models\User;

class UserRepository 
{  

    public function registrar($registro)
    {
        return User::create($registro);
    }
}