<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    die("Please login");
}

echo "<h2>Student Profile</h2>";
echo "User ID: ".$_SESSION['user_id'];
?>

<br><br>

<a href="courses.php">
View Courses
</a>