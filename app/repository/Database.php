<?php

namespace VagOff\App\repository;

use PDO;

class Database
{
    private const array DEFAULT_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Le indicamos que en caso de errores lance excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Configurar el modo de obtención de resultados (mediante arrays asociativos)
        PDO::ATTR_EMULATE_PREPARES => false,                  // Desactiva las consultas preparadas emuladas, haciendo las consultas más seguras contra inyecciones SQL.
    ];

    private PDO $connection;

    public function __construct(
        private string $dsn,
        private string $user,
        private string $password,
    )
    {
        try {
            $this->connection = new PDO($dsn, $user, $password, self::DEFAULT_OPTIONS);
            echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }

    public function executeStatement(string $sql, array $params): int
    {
        $statement = $this->connection->prepare($sql)->execute($params);
        return $statement->rowCount();
    }

    public function executeQuery(string $sql, array $params): array
    {
        $query = $this->connection->prepare($sql)->execute($params);
        return $query->fecthAll();
    }

    public function closeConnection(): void
    {
        $this->connection = null;
    }
}