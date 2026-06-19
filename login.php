<?php
session_start();
include '../config/db.php';

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $stmt=$conn->prepare(
    "SELECT * FROM users
    WHERE username=? AND role='admin'"
    );

    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result=$stmt->get_result();

    if($result->num_rows>0)
    {
        $admin=$result->fetch_assoc();

        if(password_verify(
            $password,
            $admin['password']
        ))
        {
            $_SESSION['admin_id']=$admin['id'];
            $_SESSION['admin_name']=$admin['username'];

            header("Location: dashboard.php");
            exit();
        }
    }

    $error="Invalid Login";
}
?>

<h2>Admin Login</h2>

<?php
if(isset($error))
{
    echo $error;
}
?>

<form method="POST">

Username

<br>

<input type="text" name="username">

<br><br>

Password

<br>

<input type="password" name="password">

<br><br>

<button name="login">
Login
</button>

</form>