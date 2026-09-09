<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user = $_SESSION['user_id'];

$id = $_GET['id'];

$types = $pdo->query("SELECT * FROM exercise_types");

$stmt = $pdo->prepare("SELECT * FROM workouts WHERE id=? AND user_id=?");
$stmt->execute([$id,$user]);

$workout = $stmt->fetch();

if(!$workout){
    header("Location: workouts.php");
    exit();
}

if(isset($_POST['update'])){

    $type = $_POST['exercise'];
    $duration = $_POST['duration'];
    $calories = $_POST['calories'];
    $date = $_POST['date'];

    $update = $pdo->prepare("
    UPDATE workouts
    SET exercise_type_id=?,duration=?,calories=?,workout_date=?
    WHERE id=? AND user_id=?
    ");

    $update->execute([
        $type,
        $duration,
        $calories,
        $date,
        $id,
        $user
    ]);

    header("Location: workouts.php");
    exit();
}

include "includes/header.php";
?>

<h1>Workout bewerken</h1>

<form method="post">

<label>Oefening</label>

<select name="exercise">

<?php foreach($types as $type){ ?>

<option
value="<?= $type['id'] ?>"
<?= $workout['exercise_type_id']==$type['id']?'selected':'' ?>>

<?= htmlspecialchars($type['name']) ?>

</option>

<?php } ?>

</select>

<label>Minuten</label>

<input
type="number"
name="duration"
value="<?= $workout['duration'] ?>"
required>

<label>Calorieën</label>

<input
type="number"
name="calories"
value="<?= $workout['calories'] ?>"
required>

<label>Datum</label>

<input
type="date"
name="date"
value="<?= $workout['workout_date'] ?>"
required>

<button name="update">

Opslaan

</button>

</form>

<?php include "includes/footer.php"; ?>