<?php
session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include '../config/db.php';

$userCount =
$conn->query("SELECT COUNT(*) total FROM users")
->fetch_assoc()['total'];

$courseCount =
$conn->query("SELECT COUNT(*) total FROM courses")
->fetch_assoc()['total'];

$enrollCount =
$conn->query("SELECT COUNT(*) total FROM enrollments")
->fetch_assoc()['total'];
?>

<h1>Admin Dashboard</h1>

<p>Welcome <?php echo $_SESSION['admin_name']; ?></p>

<hr>

Total Users:
<?php echo $userCount; ?>

<br><br>

Total Courses:
<?php echo $courseCount; ?>

<br><br>

Total Enrollments:
<?php echo $enrollCount; ?>

<hr>

<a href="users.php">Manage Users</a>

<br><br>

<a href="courses.php">Manage Courses</a>

<br><br>

<a href="enrollments.php">Manage Enrollments</a>

<br><br>

<a href="logout.php">Logout</a>