<?php
declare(strict_types=1);

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

    public function getName(): string
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

    public function setDates(array $dates): void
    {
        $this->dates = $dates;
    }

    public function addDate(DateTime $date): DateTime
    {
        $existingDate = array_find($this->dates, fn($item) => $item == $date);

        if ($existingDate) {
            throw new DateException("Error: La fecha seleccionada ya existe.");
        }

        $this->dates[] = $date;
        return $date;
    }

    public function removeDate(DateTime $date): DateTime
    {
        $existingDate = array_find($this->dates, fn($item) => $item == $date);

        if (!$existingDate) {
            throw new DateException("Error: La fecha seleccionada no existe.");
        }

        $index = array_search($date, $this->dates);
        return array_splice($this->dates, $index, 1);
    }

    public function toggleDate(DateTime $date) {
        if (in_array($date, $this->dates)) {
            // eliminar fecha
            $index = array_search($date, $this->dates);
            return array_splice($this->dates, $index, 1);
        } else {
            // añadir fecha
            $this->dates[] = $date;
        }
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
        $dates = "<ul>";
        foreach ($this->dates as $date) {
            $dates .= "<li>" . $date->format("d/m/Y") . "</li>";
        }
        $dates .= "</ul>";

        return "<p>Task ID $this->id: $this->name </p>$dates";
    }
}