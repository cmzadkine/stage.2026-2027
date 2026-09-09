<?php

require_once "includes/auth.php";
require_once "includes/db.php";

$id = $_GET['id'];

$user = $_SESSION['user_id'];

$stmt = $pdo->prepare("

DELETE FROM workouts

WHERE id=?

AND user_id=?

");

$stmt->execute([$id,$user]);

header("Location: workouts.php");

exit();

?>