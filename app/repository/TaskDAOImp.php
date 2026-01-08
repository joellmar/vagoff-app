<?php

namespace VagOff\App\repository;

use Dotenv\Dotenv;


class TaskDAOImp implements TaskDAO
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    function insertTask(string $name, string $description): int
    {
        $sql = "INSERT INTO tasks VALUES (NULL, :name, :description)";

        $params = [
            ":name" => $name,
            ":description" => $description
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function getTaskById(string $id): array
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";

        $params = [
            ":id" => $id
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function getTaskByName(string $name): array
    {
        $sql = "SELECT * FROM tasks WHERE name = :name";

        $params = [
            ":name" => $name
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function updateTask(int $id, string $name, string $description): int
    {
        $sql = "UPDATE tasks SET name = :name, description = :description WHERE id = :id";

        $params = [
            ":name" => $name,
            ":description" => $description,
            ":id" => $id
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function deleteTaskById(int $id): int
    {
        $sql = "DELETE FROM tasks WHERE id = :id";

        $params = [
            ":id" => $id
        ];

        return $this->database->executeUpdate($sql, $params);
    }

}