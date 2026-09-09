<?php
session_start();

require_once "includes/db.php";

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");

    $stmt->execute([$email]);

    if($stmt->rowCount() == 1)
    {
        $user = $stmt->fetch();

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit;
        }
        else
        {
            $message = "Verkeerd wachtwoord.";
        }
    }
    else
    {
        $message = "Account bestaat niet.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>

<meta charset="UTF-8">

<title>Inloggen</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="form-container">

<h1>FitTrack</h1>

<h2>Inloggen</h2>

<?php

if($message != "")
{
    echo "<p class='error'>$message</p>";
}

?>

<form method="POST">

<input
type="email"
name="email"
placeholder="Email"
required>

<input
type="password"
name="password"
placeholder="Wachtwoord"
required>

<button
type="submit"
name="login">
Inloggen
</button>

</form>

<p>

Nog geen account?

<a href="register.php">

Registreer hier

</a>

</p>

</div>

</body>

</html>