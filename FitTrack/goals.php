<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user = $_SESSION['user_id'];

$stmt = $pdo->prepare("
SELECT * FROM goals
WHERE user_id=?
ORDER BY deadline ASC
");

$stmt->execute([$user]);

include "includes/header.php";
?>

<h1>Mijn Doelen</h1>

<a class="button" href="add_goal.php">+ Doel toevoegen</a>

<table>

<tr>
<th>Doel</th>
<th>Streefwaarde</th>
<th>Voortgang</th>
<th>Deadline</th>
<th>Acties</th>
</tr>

<?php while($goal = $stmt->fetch()){ ?>

<tr>

<td><?= htmlspecialchars($goal['goal_name']) ?></td>

<td><?= $goal['target'] ?></td>

<td><?= $goal['current_progress'] ?></td>

<td><?= $goal['deadline'] ?></td>

<td>

<a href="edit_goal.php?id=<?= $goal['id'] ?>">Bewerken</a>

|

<a
href="delete_goal.php?id=<?= $goal['id'] ?>"
onclick="return confirm('Weet je het zeker?')">

Verwijderen

</a>

</td>

</tr>

<?php } ?>

</table>

<?php include "includes/footer.php"; ?>