<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user = $_SESSION['user_id'];

if(isset($_POST['save'])){

$name=$_POST['goal_name'];
$target=$_POST['target'];
$progress=$_POST['progress'];
$deadline=$_POST['deadline'];

$stmt=$pdo->prepare("
INSERT INTO goals
(user_id,goal_name,target,current_progress,deadline)
VALUES(?,?,?,?,?)
");

$stmt->execute([
$user,
$name,
$target,
$progress,
$deadline
]);

header("Location: goals.php");
exit();

}

include "includes/header.php";
?>

<h1>Nieuw Doel</h1>

<form method="post">

<label>Doel</label>

<input
type="text"
name="goal_name"
required>

<label>Streefwaarde</label>

<input
type="number"
name="target"
required>

<label>Voortgang</label>

<input
type="number"
name="progress"
value="0">

<label>Deadline</label>

<input
type="date"
name="deadline">

<button name="save">

Opslaan

</button>

</form>

<?php include "includes/footer.php"; ?>