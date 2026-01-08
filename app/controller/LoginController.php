<?php

namespace VagOff\App\controller;

use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAOImp;
use VagOff\App\repository\UserDAOImp;
use VagOff\App\service\LoginService;

class LoginController {

    public function __construct(
        private LoginService $loginService
    ) {}

    public function startApp(): void
    {
        include __DIR__ . "/../view/welcomeScreen.php";
    }

    public function register(): false|int {

        if (!isset($_POST["registerButton"])) {
            include __DIR__ . "/../view/registerForm.php";
            return false;
        }

        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["pwdConfirm"])) {
            $_SESSION["error"] = "Fields can't be empty";
            include __DIR__ . "/../view/registerForm.php";
            return false;
        }

        if ($_POST["password"] !== $_POST["pwdConfirm"]) {
            $_SESSION["error"] = "Passwords don't match";
            include __DIR__ . "/../view/registerForm.php";
            return false;
        }

        $username = $this->sanitizeInputField("username");
        $password = $_POST["password"];
        $rowCount = $this->loginService->registerUser($username, $password);

        if ($rowCount === -1) {
            include __DIR__ . "/../view/registerForm.php";
            return false;
        }

        $_SESSION["info"] = "Your account has been created successfully.";
        return $rowCount;
    }

    public function logIn(): User|false {
        if (!isset($_POST["loginButton"])) {
            include __DIR__ . "/../view/loginForm.php";
            return false;
        }

        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $_SESSION["error"] = "Fields can't be empty";
            include __DIR__ . "/../view/loginForm.php";
            return false;
        }

        $username = $this->sanitizeInputField("username");
        $password = $_POST["password"];
        $isAuthorized = $this->loginService->authorizeUser($username, $password);

        if (!$isAuthorized) {
            include __DIR__ . "/../view/loginForm.php";

            return false;
        }

        $this->loginService->getUserTasks();

        $_SESSION["info"] = "You've started session.";

        return $isAuthorized;
    }

    public function showHomePage(): bool {
        if (!$_SESSION["user"]) {
            $_SESSION["error"] = "Access error: invalid user in current session.";
            include __DIR__ . "/../view/loginForm.php";
            return false;
        }

        include __DIR__ . "/../view/homePage.php";
        return true;
    }

    private function sanitizeInputField(string $fieldName): mixed {
        return filter_input(INPUT_POST, $fieldName, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? "";
    }
}