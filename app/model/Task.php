<?php

namespace VagOff\App\Model;

use DateException;
use DateTime;

class Task
{
    private static int $idCounter = 1;

    private int $id;
    private string $name;
    private array $dates;

    public function __construct(string $name)
    {
        $this->id = self::$idCounter++;
        $this->name = $name;
        $this->dates = [];
    }

    public static function getIdCounter(): int
    {
        return self::$idCounter;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): int
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDates(): array
    {
        return $this->dates;
    }

    public function addDate(DateTime $date): DateTime
    {
        $date = array_find($this->dates, fn($item) => $item->getTimestamp() == $date->getTimestamp());

        if ($date) {
            throw new DateException("Error: La fecha seleccionada ya existe.");
        }

        $this->dates[] = $date;
        return $date;
    }

    public function removeDate(DateTime $date): DateTime
    {
        $date = array_find($this->dates, fn($item) => $item->getTimestamp() == $date->getTimestamp());

        if (!$date) {
            throw new DateException("Error: La fecha seleccionada no existe.");
        }

        $index = array_search($date, $this->dates);
        return array_splice($this->dates, $index, 1);
    }

    public function isCompleted(DateTime $date): bool {
        return in_array($date, $this->dates);
    }

    public function printDates(): void
    {
        foreach ($this->dates as $date) {
            echo $date;
        }
    }

    public function __toString(): string
    {
        $dates = "<ul>Dates:";
        foreach ($this->dates as $date) {
            $dates .= "<li>$date</li>";
        }
        $dates .= "</ul>";

        $completed = $this->completed ? "Completed" : "Uncompleted";

        return "<p>Task ID $this->id: $this->name ($completed)</p>$dates";
    }
}