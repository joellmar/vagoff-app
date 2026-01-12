<?php

declare(strict_types=1);

use VagOff\App\controller\LoginController;
use VagOff\App\controller\TaskController;
use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAOImp;
use VagOff\App\repository\Database;
use VagOff\App\repository\TaskDAOImp;
use VagOff\App\repository\UserDAOImp;
use VagOff\App\service\LoginService;
use VagOff\App\service\TaskService;

require __DIR__ . "/../vendor/autoload.php";

session_start();

$loginUrl = __DIR__ . "/../app/view/loginForm.php";

try {
    $database = new Database();
    $userDao = new UserDAOImp($database);
    $taskDao = new TaskDAOImp($database);
    $completionDao = new CompletionDAOImp($database);
    $userModel = $_SESSION["user"] ?? new User();
    $loginService = new LoginService($userDao, $completionDao, $userModel);
    $taskService = new TaskService($taskDao, $completionDao, $userModel);
    $loginController = new LoginController($loginService);
    $taskController = new TaskController($taskService);

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

        header("Location: index.php?action=login");
        exit();
    }

    if ($action === "login") {
        $result = $loginController->logIn();

        if (!$result) {
            $_SESSION["error"] = "";
            exit();
        }

        header("Location: index.php?action=home");
        exit();
    }

    if ($action === "home") {
        $result = $taskController->showHomePage();

        if (!$result) {
            $_SESSION["error"] = "";
        }

        exit();
    }


} catch (Exception $e) {
    echo "An error has ocurred: " . $e->getMessage();
}

