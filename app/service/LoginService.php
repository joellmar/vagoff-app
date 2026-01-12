<?php

namespace VagOff\App\service;

use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAO;
use VagOff\App\repository\UserDAO;

class LoginService
{
    private const string SESSION_KEY = "user";

    public function __construct(
        private UserDAO $userDao,
        private CompletionDAO $completionDao,
        private User $user
    ) {}

    public function registerUser(string $username, string $password): int {
        $results = $this->userDao->getUserByName($username);

        if ($results) {
            return -1;
        }

        return $this->userDao->insertUser($username, $password);
    }

    public function authenticateUser(string $username, string $password): bool {
        $results = $this->userDao->getUserByName($username);

        if (empty($results)) {
            $_SESSION["error"] = "There doesn't exist an user account with that username";
            return false;
        }

        $dbUser = $results[0];
        $isVerified = password_verify($password, $dbUser["password"]);

        $_SESSION["error"] = "Si se ve este error es porque no se ha podido verificar correctamente la contraseña.";
        return ($dbUser && $isVerified);
    }

    public function authorizeUser(string $username, string $password): User|false {
        if(!$this->authenticateUser($username, $password)) {
            return false;
        }

        $dbUser = $this->userDao->getUserByName($username)[0];

        $this->user->setId($dbUser["id"])->setUsername($dbUser["username"])->setPassword("password");
        $_SESSION[self::SESSION_KEY] = $this->user;

        return $this->user;
    }

    public function getUserTasks(): array
    {
        $userTasks = $this->completionDao->getTasksByUser($this->user->getId());
        $this->user->setTasks($userTasks);

        return $userTasks;
    }
}