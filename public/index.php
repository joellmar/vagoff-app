<?php

declare(strict_types=1);

use VagOff\App\Model\Task;
use VagOff\App\Service\TaskManager;

// CONFIGURACIÓN (Cerebro) 🧠
// Cargamos la clase TaskManager
require __DIR__ . "/../vendor/autoload.php";

// Iniciamos sesión
session_start();

// INICIALIZACIÓN (Memoria) 💾
// Recuperamos el taskManager de sesión o creamos uno nuevo
if (!isset($_SESSION["taskManager"])) {
    $_SESSION["taskManager"] = new TaskManager();
}

// CONTROLADOR (Lógica de Negocio) ⚙️
try {
    // a. Validar
    if (isset($_POST["addButton"])) {
        if (empty($_POST["newTask"])) {
            $_SESSION["error"] = "You have to introduce a task";

        } else {
            $taskName = filter_input(INPUT_POST, "newTask", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // b. Operar (addTask)
            // c. Guardar
            $_SESSION["taskManager"]->addTask(new Task($taskName));
        }

        // d. REDIRIGIR (header + exit) -> ¡Aquí acaba el script si hay envío!
        // Patrón PRG (POST-REDIRECT-GET) -> Evita que en las recargas los datos del formulario se manden por duplicado.
        // La redirección se hace siempre con GET.
        header("Location: index.php");
        exit();
    }

    if (isset($_GET["id"])) {
        $taskId = $_GET["id"];
        $date = $_POST["dateSelect"];
        $_SESSION["taskManager"]->addDateToTask($taskId, $date);
    }

} catch (Exception $e) {
    $e->getMessage();
}

// VISTA (Presentación) 🎨
// Si llegamos aquí, es que NO se envió formulario o ya se procesó.
include __DIR__ . "/../app/view/dateSelector.php";
include __DIR__ . "/../app/view/newTask.php";
include __DIR__ . "/../app/view/taskList.php";

?>


