<?php
include 'connection.php';



$sql = "SELECT spot_number FROM reservation";
$result = $con->query($sql);
$spots = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $spots[$row["spot_number"]] = 1;
    }
}
$con->close();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parking Lot</title>
    <style>
        .parking-lot {
            display: flex;
            flex-wrap: wrap;
            width: 550px;
            margin: 40px auto;
            border: 2px solid #333;
            padding: 30px;
            position: relative; /* Ensure position relative for the parking lot */
        }

        .spot {
            width: 40px;
            height: 70px;
            background-color: #ccc;
            border: 1px solid #999;
            margin: 5px;
        }


        </style>
    </head>
<body>
    <div class="parking-lot">
        <?php for ($i = 1; $i <= 100; $i++): ?>
            <div class="spot" style="background-color: <?php echo isset($spots[$i]) && $spots[$i] ? 'red' : 'green';?>;"></div>
            <?php echo $i; ?>
        <?php endfor; ?>
    </div>
</body>
</html>