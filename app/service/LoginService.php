<?php

namespace VagOff\App\service;

use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAO;
use VagOff\App\repository\CompletionDAOImp;
use VagOff\App\repository\UserDAO;
use VagOff\App\repository\UserDAOImp;

class LoginService
{
    private const SESSION_kEY = "user";

    public function __construct(
        private UserDAO $userDao = new UserDAOImp(),
        private CompletionDAO $completionDao = new CompletionDAOImp(),
        private User $user = new User())
    {}

    public function registerUser(string $username, string $password): int {
        $dbUser = $this->userDao->getUserByName($username);

        if ($dbUser) {
            return -1;
        }

        return $this->userDao->insertUser($username, $password);
    }

    public function authenticateUser(string $username, string $password): bool {
        $dbUser = $this->userDao->getUserByName($username)[0];
        $isVerified = password_verify($password, $dbUser["password"]);

        return ($dbUser && $isVerified);
    }

    public function authorizeUser(string $username, string $password): User|false {
        if(!$this->authenticateUser($username, $password)) {
            return false;
        }

        $dbUser = $this->userDao->getUserByName($username)[0];

        $this->user->setId($dbUser["id"])->setUsername($dbUser["username"])->setPassword("password");
        $_SESSION[self::SESSION_kEY] = $this->user;

        return $this->user;
    }

    public function getUserTasks(): array
    {
        $userTasks = $this->completionDao->getTasksByUser($this->user->getId());
        $this->user->setTasks($userTasks);

        return $userTasks;
    }
}