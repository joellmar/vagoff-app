<?php

namespace VagOff\App\service;

use DateTime;
use VagOff\App\Model\Task;
use VagOff\App\model\User;
use VagOff\App\repository\CompletionDAO;
use VagOff\App\repository\TaskDAO;

class TaskService
{
    public function __construct(
        private TaskDAO $taskDao,
        private CompletionDAO $completionDao,
        private User $user
    ) {}

    public function createTask(string $name, string $description, array $dates): bool {
        if (!$this->user) {
            return false;
        }

        if ($this->doesTaskExists($name)) {
            return false;
        }

        $result = $this->taskDao->insertTask($name, $description);

        if ($result < 1) {
            return false;
        }

        $task = $this->taskDao->getTaskByName($name)[0];
        $this->assignDatesToTask($task, $dates);
        return true;
    }

    public function getAllTasksByDate(DateTime $date): false|array
    {
        if (!$this->user) {
            return false;
        }

        return $this->completionDao->getTasksByUserAndDate($this->user->getId(), $date);
    }


    public function doesTaskExists(string $name): bool
    {
        $hasTasks = $this->completionDao->getTasksByUser($this->user->getId());
        return $hasTasks && $this->taskDao->getTaskByName($name);
    }


    public function assignDatesToTask(Task $task, array $dates): void
    {
        foreach ($dates as $date) {
            $this->completionDao->assignTaskToUser($this->user->getId(), $task->getId(), $date);
        }
    }


}