<?php
$conn = new mysqli(process.env.DB_HOST, process.env.DB_USERNAME, process.env.DB_PASSWORD, process.env.DB_DBNAME);
if ($conn->connect_error) {
    die("Ошибка: " . $conn->connect_error);

}
