<?php
session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$result=
$conn->query(
"SELECT * FROM courses"
);
?>

<h2>Courses</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Course</th>
<th>Description</th>
<th>Fee</th>
</tr>

<?php

while($row=$result->fetch_assoc())
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>RM <?php echo $row['fee']; ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a href="admin_dashboard.php">
Back
</a>