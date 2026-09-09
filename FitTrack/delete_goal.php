<?php

require_once "includes/auth.php";
require_once "includes/db.php";

$user=$_SESSION['user_id'];

$id=$_GET['id'];

$stmt=$pdo->prepare("
DELETE FROM goals
WHERE id=? AND user_id=?
");

$stmt->execute([$id,$user]);

header("Location: goals.php");
exit();

?>