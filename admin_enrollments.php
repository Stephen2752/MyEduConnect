<?php
session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$sql="
SELECT
enrollments.id,
users.username,
courses.title,
enrollments.enroll_date

FROM enrollments

JOIN users
ON enrollments.user_id=users.id

JOIN courses
ON enrollments.course_id=courses.id
";

$result=$conn->query($sql);
?>

<h2>Enrollments</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Student</th>
<th>Course</th>
<th>Date</th>
</tr>

<?php

while($row=$result->fetch_assoc())
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['enroll_date']; ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a href="admin_dashboard.php">
Back
</a>