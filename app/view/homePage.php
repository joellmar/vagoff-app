<?php

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
        </header>

        <nav>
            <a href="">Tasks</a>
            <a href="">Dates</a>
            <a href="">Profile</a>
        </nav>

        <main>

        </main>
    </body>
</html>
