<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(
        UserService $userService,
    ){
        $this->userService = $userService;
    }

    public function Logar( Request $request)
    {
        $login=$request->only(['email','password']);
        return $this->userService->logar($login);
    }

    public function registrar(Request $request)
    {
        $registro=$request->all();
        return $this->userService->registrar($registro);

    }

    public function deslogar()
    {
        Auth::logout();
        return new JsonResponse("Usuário deslogado!");
    }
}
