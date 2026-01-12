<?php

namespace VagOff\App\repository;

use DateTime;

interface CompletionDAO
{
    function assignTaskToUser(int $userId, int $taskId, DateTime $date): int;

    function completeTask(int $userId, int $taskId, DateTime $date): int;

    function getTasksByUser(int $userId): array;

    function getTasksByUserAndDate(int $userId, DateTime $date): array;

    function getUsersByTask(int $taskId): array;
}