<?php
    $error = $_SESSION["error"] ?? "";
    echo "La vista se está ejecutando";
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>
    <body>
        <form action="index.php?action=login" method="post">
            <h1>Log In</h1>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="50" required>
                <span><?= $error ?></span>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="50" required>
                <span><?= $error ?></span>
            </div>

            <button type="submit" name="loginButton">Log In</button>
        </form>
        <a href="index.php?action=register">Register</a>
    </body>
</html>