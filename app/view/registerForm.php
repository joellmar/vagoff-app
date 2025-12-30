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
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <h1>Register</h1>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" maxlength="50" required>
            <span><?= $error ?></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" maxlength="50" required>
            <span><?= $error ?></span>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" maxlength="50" required>
            <span><?= $error ?></span>
        </div>
        <div>
            <label for="pwd-confirm">Confirm Password</label>
            <input type="password" id="pwd-confirm" name="pwd-confirm" placeholder="Password" maxlength="50" required>
            <span><?= $error ?></span>
        </div>
        <button type="submit" name="register-button">Register</button>
    </form>
</body>
</html>