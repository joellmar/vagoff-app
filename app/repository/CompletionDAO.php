<?php

namespace VagOff\App\repository;

use DateTime;

interface CompletionDAO
{
    function assignTaskToUser(int $userId, int $taskId, DateTime $dateTime): int;

    function completeTask(int $userId, int $taskId, DateTime $dateTime): int;

    function getTasksByUser(int $userId): array;

    function getUsersByTask(int $taskId): array;
}