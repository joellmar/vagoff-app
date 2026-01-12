<?php
$tasks = $_SESSION["tasks"] ?: [];
$selectedDate = $_SESSION["selectedDate"] ?? new DateTime()->format("Y-m-d");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home</title>
    </head>
    <body>
        <header>
            <h1><?= "Welcome, " . htmlspecialchars($_SESSION["user"]->getUsername()) ?></h1>
            <h2><?= $_SESSION["info"] ?></h2>
            <form action="index.php?action=home" method="post">
                <label for="date-select">Date</label>
                <input type="date" id="date-select" name="dateSelector" max="<?= $selectedDate ?>" onchange="this.form.submit()" value="<?= $selectedDate ?>">
            </form>
        </header>

        <nav>
            <a href="">Tasks</a>
            <a href="">Dates</a>
            <a href="">Profile</a>
        </nav>

        <main>
            <h2>Tasks</h2>
<!--            Impresión de prueba -->
            <p><?= "tareas: " . $tasks[0] ?></p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Completed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($tasks as $task) {
                            echo "<td>" . $task->getId() . "</td>";
                            echo "<td>" . $task->getName() . "</td>";
                            echo "<td>" . $task->getDescription() . "</td>";
                            echo "<td>" . $task->getDate()->format("d/m/y") . "</td>";
                            echo "<td>" . ($task->isCompleted() ? "Yes" : "No") . "</td>";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>
