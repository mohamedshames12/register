<?php

    include 'conn.php';

    if(isset($_POST['register'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $password = $_POST['password'];
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        $confirm_password = $_POST['confirm-password'];
        $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);



        $verify_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $verify_email->execute([$email]);

        if ($verify_email->rowCount() > 0) {
            echo 'your email is verified!';
        }else {
            if($password !== $confirm_password) {
                echo 'your passwords not match!';
            }else {
                $insert_email = $conn->prepare("INSERT INTO users(name, email, password) VALUES(?,?,?)");
                $insert_email->execute([$name,$email, $password]);
                echo 'your email is successfully!';
            }
        }


    }
?>




<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 5px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: none;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <input type="submit" value="Register" name="register">
        </form>
    </div>
</body>
</html>