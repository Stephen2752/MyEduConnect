<?php

session_set_cookie_params([
    'lifetime'=> 0,
    'path'=> '/',
    'secure'=> true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();
include 'config/db.php';

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM users
         WHERE username=?"
    );

    $stmt->bind_param(
        "s",
        $username
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if($user = $result->fetch_assoc())
    {
        // Account locked
        if($user['failed_attempts'] >= 5)
        {
            die("Account Locked");
        }

        if(password_verify(
            $password,
            $user['password']
        ))
        {
            // Reset counter
            $reset = $conn->prepare(
                "UPDATE users
                 SET failed_attempts=0
                 WHERE id=?"
            );

            $reset->bind_param(
                "i",
                $user['id']
            );

            $reset->execute();

            session_regenerate_id(true);

            $_SESSION['user_id']=$user['id'];

            header("Location: profile.php");
            exit();
        }
        else
        {
            // Increase counter
            $newAttempts =
            $user['failed_attempts'] + 1;

            $update = $conn->prepare(
                "UPDATE users
                 SET failed_attempts=?
                 WHERE id=?"
            );

            $update->bind_param(
                "ii",
                $newAttempts,
                $user['id']
            );

            $update->execute();

            echo "Invalid password";
        }
    }
    else
    {
        echo "User not found";
    }
}
?>

<form method="post">
Username:
<input name="username">

<br><br>

Password:
<input type="password" name="password">

<br><br>

<button name="login">
Login
</button>
</form>