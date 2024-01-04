<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
}

.reservation-list {
  width: 80%;
  margin: 20px auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 3px solid black;
  padding: 8px;
  
  text-align: left;
}

th {
  background-color: #6b2c91;
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
  <title>View Reservations</title>
  
</head>
<body>
  <div class="reservation-list">
    <h2>Your Reservations</h2>
    <table>
      <tr>
        <th style="color:white">Entry Date</th>
        <th style="color:white">Quitting Date</th>
        <th style="color:white">Spot Number</th>
        <th style="color:white">Reservation code</th>
        <th style="color:white">Price(MAD)</th>
        
      </tr>

      
      <?php
      session_start();
      $servername = "localhost";
      $user = "root";
      $password = "Yassine@22@";
      $dbname = "prs";

      $conn = new mysqli($servername, $user, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $username = $_SESSION['username'];
      
      // Fetch reservations from the database
      $sql = "SELECT entry_date, quitting_date, spot_number, price, reservation_code FROM reservation WHERE username = '$username'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["entry_date"] . "</td><td>" . $row["quitting_date"] . "</td><td>" . $row["spot_number"] . "</td><td>" .
             $row["reservation_code"] . "</td><td>" . $row["price"] . "</td></tr>";
      }} else {
        echo "<tr><td colspan='5'>No reservations found</td></tr>";
      }
      $conn->close();
      ?>
          </table>
        </div>
        <button onclick="window.location.href='home.php'">Home</button>
    </body>
</html>