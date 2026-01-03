<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>




<?php

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "php_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection Failed" . $conn->connect_error);

}

?>