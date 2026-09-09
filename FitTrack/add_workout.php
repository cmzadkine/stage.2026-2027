<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user_id = $_SESSION['user_id'];

$types = $pdo->query("SELECT * FROM exercise_types");

if(isset($_POST['save']))
{

$type = $_POST['exercise'];

$duration = $_POST['duration'];

$calories = $_POST['calories'];

$date = $_POST['date'];

$stmt = $pdo->prepare("

INSERT INTO workouts

(user_id,exercise_type_id,duration,calories,workout_date)

VALUES (?,?,?,?,?)

");

$stmt->execute([

$user_id,

$type,

$duration,

$calories,

$date

]);

header("Location: workouts.php");

exit();

}

include "includes/header.php";
?>

<h1>Workout toevoegen</h1>

<form method="post">

<label>Oefening</label>

<select name="exercise">

<?php foreach($types as $type){ ?>

<option value="<?= $type['id'] ?>">

<?= htmlspecialchars($type['name']) ?>

</option>

<?php } ?>

</select>

<label>Minuten</label>

<input
type="number"
name="duration"
required>

<label>Calorieën</label>

<input
type="number"
name="calories"
required>

<label>Datum</label>

<input
type="date"
name="date"
required>

<button
name="save">

Opslaan

</button>

</form>

<?php include "includes/footer.php"; ?>