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
    private array $users;
    private array $dates;

    public function __construct(string $name, string $description)
    {
        $this->id = 0;
        $this->name = $name;
        $this->description = $description;
        $this->users = [];
        $this->dates = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    public function getDates(): array
    {
        return $this->dates;
    }

    public function setDates(array $dates): void
    {
        $this->dates = $dates;
    }

    public function addDate(DateTime $date): self
    {
        $existingDate = array_find($this->dates, fn($item) => $item == $date);

        if ($existingDate) {
            throw new DateException("Error: La fecha seleccionada ya existe.");
        }

        $this->dates[] = $date;
        return $this;
    }

    public function removeDate(DateTime $date): self
    {
        $existingDate = array_find($this->dates, fn($item) => $item == $date);

        if (!$existingDate) {
            throw new DateException("Error: La fecha seleccionada no existe.");
        }

        $index = array_search($date, $this->dates);
        array_splice($this->dates, $index, 1);

        return $this;
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

        return "Task ID $this->id: $this->name - $dates";
    }
}