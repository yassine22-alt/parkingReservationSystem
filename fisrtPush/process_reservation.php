<?php
$spotNumber = $_POST['spotNumber'];
$entryDate = $_POST['entryDate'];
$entryTime = $_POST['entryTime'];
$quittingDate = $_POST['quittingDate'];
$quittingTime = $_POST['quittingTime'];
$entryDateTime = $entryDate . ' ' . $entryTime;
$quittingDateTime = $quittingDate . ' ' . $quittingTime;

session_start();
$username = $_SESSION['username'];
$fees = 0;

$reservationCode = generateReservationCode();

$servername = "localhost";
$user = "root";
$password = "Yassine@22@";
$dbname = "prs";

$conn = new mysqli($servername, $user, $password, $dbname);

// // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Insert the reservation into the database
$pricePerHour = 2.5;
$fees = SetPrice($entryDateTime,$quittingDateTime,$pricePerHour);
$reserved = 0;
$sql = "INSERT INTO reservation (username, spot_number, entry_date, quitting_date, price, reservation_code) VALUES ('$username', '$spotNumber', '$entryDateTime', '$quittingDateTime', '$fees', '$reservationCode')";

if ($conn->query($sql) === TRUE) {
    $reserved = 1;
} else {
    header('location:spot_3amr.html');
}
if ($reserved == 1) {
    header('location:confirmation.html');
}

function getHolidays($countryCode, $year) {
    $url = "https://date.nager.at/Api/v2/PublicHolidays/$year/$countryCode";
    
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    // Execute cURL session and get the response
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response
    return json_decode($response, true);
}
function getFreeParkingSpots($conn) {
    $totalSpots = 100;
    $threshold = $totalSpots * 0.2;
    
    $count = "SELECT * FROM reservation";
    $res = mysqli_query($conn,$count);
    $demandFactor = 0;
    $freeSpots = $totalSpots - mysqli_num_rows($res);
    if ($freeSpots <= $threshold && $freeSpots != 0) {
        $demandFactor = 1 - ($freeSpot / $totalSpots);
    }
    return $demandFactor;
}
function SetPrice($entryDateTime, $quittingDateTime, $normalPricePerHour) {
    global $conn;
    $price = 0;

    // time of day
    $entryDate = date_parse($entryDateTime);
    $quittingDate = date_parse($quittingDateTime);

    $entryHour = $entryDate['hour'];
    $quittingHour = $quittingDate['hour'];
    while ($entryHour != $quittingHour) {
        
        if ($entryHour >= 0 && $entryHour <= 12) {
            $price += ($normalPricePerHour*2);
        }
        if ($entryHour > 12 && $entryHour <= 18) {
            $price += ($normalPricePerHour*3);
        }
        if ($entryHour > 18 && $entryHour < 24) {
            $price += ($normalPricePerHour*4);
        }
        $entryHour += 1;
        $entryHour %= 24;
    }
    
    // day of week
    $entryYMD = new DateTime($entryDateTime);
    $dayOfWeek = $entryYMD->format('N');

    $isWeekend = ($dayOfWeek == 6 || $dayOfWeek == 7);

    if ($isWeekend) {
        $price *= 2;
    }
    
    //Special events(Holidays)
    $countryCode = "MA"; 
    $year = $entryYMD->format('Y');
    $holidays = getHolidays($countryCode, $year);
    $entryYMD = $entryYMD->format('Y-m-d');
    foreach ($holidays as $holiday) {
        if ($holiday['date'] == $entryYMD) {
            $price *=1.5;
        }
    }
    //Demand
    $demandRate = getFreeParkingSpots($conn);
    $price = (1+$demandRate)*$price;
    return $price;
}



// Function to generate a random reservation code
function generateReservationCode() {
    $codeLength = 6; // You can adjust the length as needed
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $reservationCode = '';

    for ($i = 0; $i < $codeLength; $i++) {
        $reservationCode .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $reservationCode;
}
$conn->close();
?>
