
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

.container {
  width: 80%;
  margin: 50px auto;
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #6a1b9a;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

label {
  margin-bottom: 10px;
  color: #333;
}

input[type="text"] {
  width: 250px;
  padding: 8px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.cancel-btn {
  background-color: #d32f2f;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.cancel-btn:hover {
  background-color: #b71c1c;
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
</style>
  <title>Cancel Reservation</title>
  
</head>
<body>

  <div class="container">
    <h1>Cancel Reservation</h1>
    <form id="cancelForm" action="cancel_reservation.php" method="post">
      <label for="spot_number" >Enter Spot Number:</label>
      <input type="text" id="spotNumber" name="spot_number" placeholder="Enter spot number" required>
      <button type="submit" class="cancel-btn">Cancel</button>
    </form>
  </div>

</body>
</html>