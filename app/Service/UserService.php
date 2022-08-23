<?php

namespace App\Service;

use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {

    protected $userService; 

public function __construct(
    UserRepository $userRepository
){
    $this->userRepository = $userRepository;
}

public function logar($login)
{
    if (!Auth::attempt($login)){
        return new JsonResponse("Usuário ou Senha inválidos.");
    }
    return new JsonResponse("Usuário logado!");
}

public function registrar($registro)
{
    $registro['password']=Hash::make($registro['password']);
    $this->userRepository->registrar($registro);

    Auth::login($registro);
    return New JsonResponse("Usuário criado!");
}
}