<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user=$_SESSION['user_id'];
$id=$_GET['id'];

$stmt=$pdo->prepare("
SELECT * FROM goals
WHERE id=? AND user_id=?
");

$stmt->execute([$id,$user]);

$goal=$stmt->fetch();

if(!$goal){
header("Location: goals.php");
exit();
}

if(isset($_POST['update'])){

$update=$pdo->prepare("
UPDATE goals
SET goal_name=?,
target=?,
current_progress=?,
deadline=?
WHERE id=? AND user_id=?
");

$update->execute([
$_POST['goal_name'],
$_POST['target'],
$_POST['progress'],
$_POST['deadline'],
$id,
$user
]);

header("Location: goals.php");
exit();

}

include "includes/header.php";
?>

<h1>Doel Bewerken</h1>

<form method="post">

<input
type="text"
name="goal_name"
value="<?= htmlspecialchars($goal['goal_name']) ?>"
required>

<input
type="number"
name="target"
value="<?= $goal['target'] ?>"
required>

<input
type="number"
name="progress"
value="<?= $goal['current_progress'] ?>">

<input
type="date"
name="deadline"
value="<?= $goal['deadline'] ?>">

<button name="update">

Opslaan

</button>

</form>

<?php include "includes/footer.php"; ?>