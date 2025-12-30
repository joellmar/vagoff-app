<?php

namespace VagOff\App\controller;

use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAOImp;
use VagOff\App\repository\UserDAOImp;
use VagOff\App\service\LoginService;

class LoginController
{

    public function __construct(
        private LoginService $loginService = new LoginService()
    ) {}

    function initApp(): false|User
    {
        include __DIR__ . "/../view/loginForm.php";

        //TODO añadir validación

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        $isAuthorized = $this->loginService->authorizeUser($username, $password);

        if ($isAuthorized) {
            $this->loginService->getUserTasks();
        }

        return $isAuthorized;
    }

    function registerUser(): int
    {
        include __DIR__ . "/../view/registerForm.php";

        // TODO añadir validación

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        $isRegistered = $this->loginService->registerUser($username, $password);

        return $isRegistered;
    }
}