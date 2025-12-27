<?php

namespace VagOff\App\repository;

use DateTime;
use Dotenv\Dotenv;

class CompletionDAOImp implements CompletionDAO
{
    private Dotenv $dotenv;
    private Database $database;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable(__DIR__);
        $this->dotenv->safeLoad();

        $this->database = new Database($_ENV["DNS"], $_ENV["USER"], $_ENV["PASSWORD"]);
    }

    function assignTaskToUser(int $userId, int $taskId, DateTime $doneDate): int
    {
        $sql = "INSERT INTO completions VALUES (:userId, :taskId, :doneDate)";

        $params = [
            ":userId" => $userId,
            ":taskId" => $taskId,
            ":doneDate" => $doneDate
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function completeTask(int $userId, int $taskId, DateTime $doneDate): int
    {
        $sql = "UPDATE completions SET completed = TRUE WHERE user_id = :userId AND task_id = :taskId AND done_date = :doneDate";

        $params = [
            ":userId" => $userId,
            ":taskId" => $taskId,
            ":doneDate" => $doneDate
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function getTasksByUser(int $userId): array
    {
        $sql = "SELECT DISTINCT task_id FROM completions WHERE user_id = :userId";

        $params = [
            ":userId" => $userId
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function getTasksByUserAndDay(int $userId, DateTime $doneDate): array {
        $sql = "SELECT DISTINCT task_id FROM completions WHERE user_id = :userId AND done_date = :doneDate";

        $params = [
            ":userId" => $userId,
            ":doneDate" => $doneDate
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function getUsersByTask(int $taskId): array
    {
        $sql = "SELECT DISTINCT user_id FROM completions WHERE task_id = :taskId";

        $params = [
            ":userId" => $taskId
        ];

        return $this->database->executeQuery($sql, $params);
    }
}