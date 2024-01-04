


<?php

$success = 0;
$invalid = 0;


if($_SERVER['REQUEST_METHOD'] =='POST'){
    include 'connection.php';
    $username=$_POST['username'];
    $password = $_POST['password'];
    

    $sql = "select * from `register` where username = '$username'";
    $result = mysqli_query($con,$sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)){
                $success=1;
                session_start();
                $_SESSION['username']=$username;
                header('location:home.php');
            }
            
            
        }else{
            $invalid=1;
        }
}
}
?>





<!doctype html>
<html lang="en">
<head>
    <style>
        .mb-3 {
            padding: 10px;
            margin-top: 10px;
            
        }
        .btn {
            color: white;
            font-weight: bold;
            padding: 6px;
            margin: 10px;
            border: 2px solid black;
            width: 100%;
            background-color: purple;
        }
        .container {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        .container label {
            display: block;
            margin-bottom: 5px;
        }
        .container input[type="text"],
        .container input[type="password"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .h1 {
            text-align: center;
        }
        .alert {
            padding: 15px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-success {
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
    <title>Login page</title>
</head>
<body>
    <?php
    if($invalid){
        echo '<div class="alert">
        <strong>Sorry ! </strong> User does not exist.
        </div>';
    }
    if($success){
        echo '<div class="login-success">
        <strong>Congrats ! </strong> You are successfully logged in.
        </div>';
    }
    ?>

    
    <h1 class="h1">Login Page</h1>
    <div class="container">
        <form action="login.php" method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your Username" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your Password" name="password">
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>
