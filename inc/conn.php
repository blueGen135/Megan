<?php
$server = 'localhost';
$user = 'root';
$password = 'c0ntr0l1@786';
$db = 'megan';
$conn = mysqli_connect($server, $user, $password, $db);
if(!$conn){
    die("Error". mysqli_connect_error());
}

?>