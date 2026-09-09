<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user_id = $_SESSION['user_id'];

$sql = $pdo->prepare("
SELECT workouts.*, exercise_types.name AS exercise
FROM workouts
INNER JOIN exercise_types
ON workouts.exercise_type_id = exercise_types.id
WHERE workouts.user_id = ?
ORDER BY workout_date DESC
");

$sql->execute([$user_id]);

include "includes/header.php";
?>

<h1>Mijn Workouts</h1>

<a class="button" href="add_workout.php">+ Workout toevoegen</a>

<table>

<tr>
<th>Datum</th>
<th>Oefening</th>
<th>Minuten</th>
<th>Calorieën</th>
<th>Acties</th>
</tr>

<?php while($row = $sql->fetch()){ ?>

<tr>

<td><?= htmlspecialchars($row['workout_date']) ?></td>

<td><?= htmlspecialchars($row['exercise']) ?></td>

<td><?= htmlspecialchars($row['duration']) ?></td>

<td><?= htmlspecialchars($row['calories']) ?></td>

<td>

<a href="edit_workout.php?id=<?= $row['id'] ?>">Bewerken</a>

|

<a href="delete_workout.php?id=<?= $row['id'] ?>"
onclick="return confirm('Workout verwijderen?')">

Verwijderen

</a>

</td>

</tr>

<?php } ?>

</table>

<?php include "includes/footer.php"; ?>