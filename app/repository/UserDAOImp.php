<?php

namespace VagOff\App\repository;

use Dotenv\Dotenv;

class UserDAOImp implements UserDAO
{
    private Dotenv $dotenv;
    private Database $database;

    public function __construct()
    {
        $this->dotenv = Dotenv::createImmutable(__DIR__);
        $this->dotenv->safeLoad();

        $this->database = new Database($_ENV["DNS"], $_ENV["USER"], $_ENV["PASSWORD"]);
    }


    function insertUser(string $username, string $password): int
    {
        $sql = "INSERT INTO users VALUES (NULL, :username, :password)";

        $params = [
            ":username" => $username,
            ":password" => $password
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function getUserById(string $id): array
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $params = [
            ":id" => $id
        ];

        return $this->database->executeQuery($sql, $params);
    }

    function updateUser(int $id, string $username, string $password): int
    {
        $sql = "UPDATE users SET username = :username, password = :password WHERE id = :id";

        $params = [
            ":username" => $username,
            ":password" => $password,
            ":id" => $id
        ];

        return $this->database->executeUpdate($sql, $params);
    }

    function deleteUserById(int $id): int
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $params = [
            ":id" => $id
        ];

        return $this->database->executeUpdate($sql, $params);
    }
}