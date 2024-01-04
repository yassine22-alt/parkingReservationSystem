
<?php
include 'connection.php';

$success = 0;
$invalid = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $spot_number = $_POST['spot_number'];
}else{
    echo "wtf";
}
session_start();
$username = $_SESSION['username'];

$sql = "DELETE FROM reservation WHERE username = '$username' and spot_number='$spot_number'";

if ($con->query($sql) === TRUE) {
    if ($con->affected_rows > 0){
        $success=1;  
    }else{
        $invalid=1;
        }
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if($invalid){
            echo '<div class="alert">
            <strong>Sorry ! </strong> There is no such reservation under your username.
            </div>';
        }
    if($success){
            echo '<div class="cancel-success">
            Your reservation is cancelled.
            </div>';
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>

body {
  font-family: Arial, sans-serif;
  background-color: #f9f9f9;
  margin: 0;
  padding: 0;
}

.alert {
    padding: 15px;
    background-color: #f44336;
    color: white;
    border-radius: 5px;
    font-size: 16px;
}
.cancel-success {
    padding: 15px;
    background-color: darkgray;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 20px;
}
button {
    padding: 10px 20px;
    margin-top: 20px;
    margin-left:80px;
    border: none;
    border-radius: 4px;
    background-color: purple;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }

button:hover {
    background-color: #6b2c91;
    }
</style>
  <title>Cancel Reservation</title>
</head>
<body>
<button onclick="window.location.href = 'home.php';">Go Back Home</button>
</body>
</html>





