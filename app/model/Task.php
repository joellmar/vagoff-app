<?php
declare(strict_types=1);

namespace VagOff\App\Model;

use DateException;
use DateTime;

class Task
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $date;
    private bool $isCompleted;

    public function __construct(int $id, string $name, string $description, DateTime $date, bool $isCompleted)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
        $this->isCompleted = $isCompleted;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Task
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Task
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Task
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Task
    {
        $this->date = $date;
        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): Task
    {
        $this->isCompleted = $isCompleted;
        return $this;
    }


    public function __toString(): string
    {
        $dates = "<ul>";
        foreach ($this->dates as $date) {
            $dates .= "<li>" . $date->format("d/m/Y") . "</li>";
        }
        $dates .= "</ul>";

        return "Task ID $this->id: $this->name - $dates";
    }
}