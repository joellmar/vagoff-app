<?php

namespace VagOff\App\controller;

use DateTime;
use VagOff\App\Model\Task;
use VagOff\App\service\LoginService;
use VagOff\App\service\TaskService;

class TaskController {
    public function __construct(
        private TaskService $taskService
    ) {}

    public function showHomePage(): bool {
        if (!$_SESSION["user"]) {
            $_SESSION["error"] = "Access error: invalid user in current session.";
            include __DIR__ . "/../view/loginForm.php";
            return false;
        }

        if (!isset($_POST["dateSelector"])) {
            $_SESSION["error"] = "Error: you must select a date.";
            include __DIR__ . "/../view/homePage.php";
            return false;
        }

        $_SESSION["selectedDate"] = new DateTime($_POST["dateSelector"]);
        $result = $this->taskService->getAllTasksByDate($_SESSION["selectedDate"]);
        $_SESSION["tasks"] = $this->convertRowsToTasks($result);
        include __DIR__ . "/../view/homePage.php";
        return true;
    }

    public function convertRowsToTasks(array $rows): array {
        $tasks = [];

        foreach ($rows as $entry) {
            $tasks[] = new Task($entry["id"], $entry["name"], $entry["description"], $entry["done_date"], $entry["completed"]);
        }

        return $tasks;
    }


}