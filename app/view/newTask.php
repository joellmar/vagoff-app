<?php

$error = $_SESSION["error"] ?? "";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Task</title>
</head>
<body>
<!--    action="" Envía a la URL en la que se encuentra el formulario (index.php), util en un include -->
    <form action="" method="post">
        <fieldset>
            <legend><h2>Add Task</h2></legend>
            <label for="newTask">Name</label>
            <input id="newTask" name="newTask" type="text" placeholder="i.e. do exercise">
            <input type="submit" name="addButton" value="addTask">
            <span><?= $error ?></span>
        </fieldset>
    </form>
</body>
</html>

