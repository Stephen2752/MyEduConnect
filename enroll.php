<?php
session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

$stmt = $conn->prepare(
    "INSERT INTO enrollments
     (user_id,course_id)
     VALUES (?,?)"
);

$stmt->bind_param(
    "ii",
    $user_id,
    $course_id
);

$stmt->execute();

echo "Enrollment Successful";
echo "<br>";
echo "<a href='payment.php'>
      Continue Payment
      </a>";
?>