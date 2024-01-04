<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        /* Style for buttons */
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6a0dad;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width : 300px;
        }

        button:hover {
            background-color: #4d0a8c;
        }

        /* Style for logout button */
        .logout-button {
            margin-top: 20px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: #ff3333;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <h1>Welcome to Our Parking</h1>
    
    <div class="button-container">
    <button onclick="location.href='visual.php'">Available Spots</button>
        <button onclick="location.href='make_reservation.html'">Make Reservation</button>
        <button onclick="location.href='view_reservations.php'">View Reservations</button>
        <button onclick="location.href='before_cancel.php'">Cancel Reservation</button>
        <button onclick="location.href='feedback.php'">Feedback</button>
        <button class="logout-button" onclick="location.href='login.php'">Logout</button>
    </div>

    
</body>
</html>
