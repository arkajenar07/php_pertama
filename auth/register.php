<?php
include('../database/connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($connection, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");

    if ($query) {
        header("Location: login.php");
    } else {
        echo "Gagal mendaftar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Register</h1>
        <form action="" method="post">
            <div class="input">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
    </section>
</body>
</html>