<?php

namespace VagOff\App\repository;

use DateTime;
use Dotenv\Dotenv;

class CompletionDAOImp implements CompletionDAO
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function assignTaskToUser(int $userId, int $taskId, DateTime $date): int
    {
        $sql = "INSERT INTO completions VALUES (:userId, :taskId, :date)";

        $params = [
            ":userId" => $userId,
            ":taskId" => $taskId,
            ":date" => $date->format("Y-m-d")
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function completeTask(int $userId, int $taskId, DateTime $date): int
    {
        $sql = "UPDATE completions SET completed = TRUE WHERE user_id = :userId AND task_id = :taskId AND done_date = :date";

        $params = [
            ":userId" => $userId,
            ":taskId" => $taskId,
            ":date" => $date->format("Y-m-d")
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function getTasksByUser(int $userId): array
    {
        $sql = "SELECT DISTINCT * FROM completions WHERE user_id = :userId";

        $params = [
            ":userId" => $userId
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function getTasksByUserAndDate(int $userId, DateTime $date): array {
        $sql = "SELECT DISTINCT tasks.id, tasks.name, tasks.description, completions.done_date, completions.completed FROM completions INNER JOIN tasks ON completions.task_id = tasks.id WHERE user_id = :userId AND done_date = :date";

        $params = [
            ":userId" => $userId,
            ":date" => $date->format("Y-m-d")
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function getUsersByTask(int $taskId): array
    {
        $sql = "SELECT DISTINCT * FROM completions WHERE task_id = :taskId";

        $params = [
            ":userId" => $taskId
        ];

        return $this->database->executeQuery($sql, $params);
    }
}