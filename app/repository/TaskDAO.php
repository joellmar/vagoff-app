<?php

namespace VagOff\App\repository;

interface TaskDAO
{
    function insertTask(string $name, string $description): int;

    function getTaskById(string $id): array;

    function updateTask(int $id, string $name, string $description): int;

    function deleteTaskById(int $id): int;

}