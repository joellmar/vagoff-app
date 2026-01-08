<?php

declare(strict_types=1);

use VagOff\App\controller\LoginController;
use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAOImp;
use VagOff\App\repository\Database;
use VagOff\App\repository\TaskDAOImp;
use VagOff\App\repository\UserDAOImp;
use VagOff\App\service\LoginService;

require __DIR__ . "/../vendor/autoload.php";

session_start();

$loginUrl = __DIR__ . "/../app/view/loginForm.php";

try {
    $database = new Database();
    $userDao = new UserDAOImp($database);
    $taskDao = new TaskDAOImp($database);
    $completionDao = new CompletionDAOImp($database);
    $userModel = new User();
    $loginService = new LoginService($userDao, $completionDao, $userModel);
    $loginController = new LoginController($loginService);

    $action = $_GET["action"] ?? null;
    $_SESSION["error"] = "";

    if ($action === null) {
        $loginController->startApp();
        $_SESSION["error"] = "";
        exit();
    }

    if ($action === "register") {
        $result = $loginController->register();

        if (!$result) {
            $_SESSION["error"] = "";
            exit();
        }

        header("Location: trueIndex.php?action=login");
        exit();
    }

    if ($action === "login") {
        $result = $loginController->logIn();

        if (!$result) {
            $_SESSION["error"] = "";
            exit();
        }

        header("Location: trueIndex.php?action=home");
        exit();
    }

    if ($action === "home") {
        $result = $loginController->showHomePage();

        if (!$result) {
            $_SESSION["error"] = "";
            exit();
        }

        exit();
    }

    
} catch (Exception $e) {
    echo "An error has ocurred: " . $e->getMessage();
}

