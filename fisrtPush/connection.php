<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='Yassine@22@';
$DATABASE='prs';


$con = mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);
if(!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>