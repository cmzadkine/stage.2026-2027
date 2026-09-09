<?php
require_once "includes/db.php";

$message = "";

if(isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if(empty($username) || empty($email) || empty($password) || empty($confirm))
    {
        $message = "Vul alle velden in.";
    }
    elseif($password != $confirm)
    {
        $message = "Wachtwoorden komen niet overeen.";
    }
    else
    {
        $check = $pdo->prepare("SELECT id FROM users WHERE email=?");
        $check->execute([$email]);

        if($check->rowCount() > 0)
        {
            $message = "Email bestaat al.";
        }
        else
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = $pdo->prepare("INSERT INTO users(username,email,password)
            VALUES(?,?,?)");

            if($insert->execute([$username,$email,$hash]))
            {
                header("Location: login.php");
                exit;
            }
            else
            {
                $message = "Er ging iets fout.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>

<meta charset="UTF-8">

<title>Registreren</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="form-container">

<h1>FitTrack</h1>

<h2>Registreren</h2>

<?php

if($message != "")
{
    echo "<p class='error'>$message</p>";
}

?>

<form method="POST">

<input
type="text"
name="username"
placeholder="Gebruikersnaam"
required>

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

<input
type="password"
name="confirm"
placeholder="Herhaal wachtwoord"
required>

<button
type="submit"
name="register">
Registreren
</button>

</form>

<p>

Heb je al een account?

<a href="login.php">

Log hier in

</a>

</p>

</div>

</body>

</html>