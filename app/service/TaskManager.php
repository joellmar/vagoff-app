<?php
declare(strict_types=1);

namespace VagOff\App\Service;

use DateException;
use DateTime;
use Exception;
use VagOff\App\Model\Task;

require __DIR__ . "/../../vendor/autoload.php";

class TaskManager
{
    private const string SESSION_KEY = "taskManager";

    private array $taskList;
//    private array $dateList;


    public function __construct()
    {
        $this->taskList = [];
//        $this->dateList = [];
    }

    public function getTaskList(): array
    {
        return $this->taskList;
    }

    public function getDateList(): array
    {
        return $this->dateList;
    }

    public function addTask(Task $task): Task {
        $existingTask = array_find($this->taskList, fn($item) => $item->getId() === $task->getId());

        if ($existingTask) {
            throw new Exception("Error: The selected task already exist."); // TODO añadir excepciones personalizadas
        }

        $this->taskList[] = $task;
        return $task;
    }

    public function removeTask(int $id): Task {
        $task = array_find($this->taskList, fn($item) => $item->getId() === $id);

        if (!$task) {
            throw new Exception("Error: The selected task doesn't exist."); // TODO añadir excepciones personalizadas
        }

        $index = array_search($task, $this->taskList);
        return array_splice($this->taskList, $index, 1);
    }

    public function searchTaskById(int $id): Task {
        $task = array_find($this->taskList, fn($item) => $item->getId() === $id);

        if (!$task) {
            throw new Exception("Error: The selected task doesn't exist.");
        }

        return $task;
    }

    public function editTask(int $id, string $name, array $dates) : Task|false {
        try {
            $task = $this->searchTaskById($id);

            $task->setName($name);
            $task->setDates($dates);
//            array_replace_recursive($this->dateList, $dates);

            return $task;
        } catch (Exception $e) {
            $e->getMessage();

            return false;
        }
    }

    public function addDateToTask(int $taskId, DateTime $date): Task|false {
        try {
            $task = $this->searchTaskById($taskId);
            $task->addDate($date);

//            if (!in_array($date, $this->dateList))  {
//                $this->dateList[] = $date;
//            }

            return $task;
        } catch (Exception $e) {
            $e->getMessage();

            return false;
        }
    }

    public function removeDateFromTask(int $taskId, DateTime $date): Task|false {
        try {
            $task = $this->searchTaskById($taskId);
            $task->removeDate($date);

//            $findDate = fn($item) => $item == $date;
//            $findTaskWithDate = fn($task) => array_find($task->getDates(), callback: $findDate);
//
//            if (in_array($date, $this->dateList) && !array_find($this->taskList, callback: $findTaskWithDate)) {
//                $index = array_search($date, $this->dateList);
//                array_splice($this->dateList, $index, 1);
//            }

            return $task;
        } catch (Exception $e) {
            $e->getMessage();

            return false;
        }
    }

    public function save(): void
    {
        $_SESSION[self::SESSION_KEY] = serialize($this);
    }

    public function printTasks(): void
    {
        foreach ($this->taskList as $task) {
            echo $task;
        }
    }

    public function printDates(): void
    {
        foreach ($this->dateList as $date) {
            echo $date;
        }
    }
}