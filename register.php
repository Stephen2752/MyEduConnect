<?php

include 'db.php';

$message = "";

if(isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $ic_number = trim($_POST['ic_number']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $plainPassword = $_POST['password'];

    // Password Policy
    if(strlen($plainPassword) < 8)
    {
        $message = "Password must be at least 8 characters.";
    }
    elseif(!preg_match('/[A-Z]/',$plainPassword))
    {
        $message = "Password must contain at least one uppercase letter.";
    }
    elseif(!preg_match('/[a-z]/',$plainPassword))
    {
        $message = "Password must contain at least one lowercase letter.";
    }
    elseif(!preg_match('/[0-9]/',$plainPassword))
    {
        $message = "Password must contain at least one number.";
    }

    else
    {
        $password = password_hash(
            $plainPassword,
            PASSWORD_DEFAULT
        );

        $stmt = $conn->prepare(
            "INSERT INTO users
            (
                username,
                email,
                password,
                full_name,
                ic_number,
                phone,
                address
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )"
        );

        $stmt->bind_param(
            "sssssss",
            $username,
            $email,
            $password,
            $full_name,
            $ic_number,
            $phone,
            $address
        );

        if($stmt->execute())
        {
            $message = "Registration Successful";
        }
        else
        {
            $message = "Username or Email already exists";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<?php
if($message != "")
{
    echo "<p>$message</p>";
}
?>

<form method="POST">

Full Name<br>
<input type="text" name="full_name" required>
<br><br>

Username<br>
<input type="text" name="username" required>
<br><br>

Email<br>
<input type="email" name="email" required>
<br><br>

IC Number<br>
<input type="text" name="ic_number" required>
<br><br>

Phone Number<br>
<input type="text" name="phone" required>
<br><br>

Address<br>
<textarea name="address" required></textarea>
<br><br>

Password<br>
<input type="password" name="password" required>
<br>

<small>
Must contain:
<ul>
<li>Minimum 8 characters</li>
<li>1 Uppercase letter</li>
<li>1 Lowercase letter</li>
<li>1 Number</li>
</ul>
</small>

<br>

<input type="submit"
name="register"
value="Register">

</form>

</body>
</html>