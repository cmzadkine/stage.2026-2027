<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- extra mobiel fix (toegevoegd) -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>FitTrack</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="landing">

<h1>FitTrack</h1>

<p>
Houd je workouts en doelen eenvoudig bij.
</p>

<a class="button" href="login.php">
Inloggen
</a>

<a class="button" href="register.php">
Registreren
</a>

</div>

</body>

</html>