<?php

require_once('db_connect.php');

if (isset($_POST['register'])) {

    $username = $_POST['username'];

    $email = $_POST['email'];

    $password = $_POST['password'];

    // Perform input validation

    // Check if user already exists

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        echo "User already exists.";

    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {

            header('Location: login.php');

            exit();

        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }

    }

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Registration</title>

</head>

<body>

    <h2>Registration</h2>

    <form action="register.php" method="POST">

        <label for="username">Username:</label>

        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>

        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>

        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="register" value="Register">

    </form>

</body>

</html>

