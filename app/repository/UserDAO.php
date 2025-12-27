<?php

namespace VagOff\App\repository;

interface UserDAO
{
    function insertUser(string $username, string $password): int;

    function getUserById(string $id): array;

    function updateUser(int $id, string $username, string $password): int;

    function deleteUserById(int $id): int;
}