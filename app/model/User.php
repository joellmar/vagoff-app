<?php

namespace VagOff\App\model;

class User
{
    public function __construct(
        private int $id,
        private string $username,
        private string $password,
        private array $tasks = []
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function setTasks(array $tasks): User
    {
        $this->tasks = $tasks;

        return $this;
    }
}