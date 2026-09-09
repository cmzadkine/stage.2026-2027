<?php
require_once "includes/auth.php";
require_once "includes/db.php";

$user_id = $_SESSION['user_id'];

$totalWorkouts = $pdo->prepare("SELECT COUNT(*) FROM workouts WHERE user_id=?");
$totalWorkouts->execute([$user_id]);
$totalWorkouts = $totalWorkouts->fetchColumn();

$totalCalories = $pdo->prepare("SELECT SUM(calories) FROM workouts WHERE user_id=?");
$totalCalories->execute([$user_id]);
$totalCalories = $totalCalories->fetchColumn();

if($totalCalories == "")
{
    $totalCalories = 0;
}

$totalMinutes = $pdo->prepare("SELECT SUM(duration) FROM workouts WHERE user_id=?");
$totalMinutes->execute([$user_id]);
$totalMinutes = $totalMinutes->fetchColumn();

if($totalMinutes == "")
{
    $totalMinutes = 0;
}

include "includes/header.php";
?>

<h1>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<div class="cards">

<div class="card">
<h2><?php echo $totalWorkouts; ?></h2>
<p>Workouts</p>
</div>

<div class="card">
<h2><?php echo $totalMinutes; ?></h2>
<p>Minuten</p>
</div>

<div class="card">
<h2><?php echo $totalCalories; ?></h2>
<p>Calorieën</p>
</div>

</div>

<h2>Snelle acties</h2>

<a class="button" href="add_workout.php">Workout toevoegen</a>

<a class="button" href="goals.php">Mijn doelen</a>

<?php include "includes/footer.php"; ?>