<?php
session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

$result=$conn->query(
"SELECT * FROM users"
);
?>

<h2>Users</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Username</th>
<th>Email</th>
<th>Role</th>

</tr>

<?php
while($row=$result->fetch_assoc())
{
?>
<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['role']; ?></td>



</tr>

<?php
}
?>

</table>

<br>

<a href="admin_dashboard.php">
Back
</a>