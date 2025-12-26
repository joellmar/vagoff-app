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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }
}