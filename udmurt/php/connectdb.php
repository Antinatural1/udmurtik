<?php
$conn = new mysqli("localhost", "root", "root", "udmurtik");
if ($conn->connect_error) {
    die("Ошибка: " . $conn->connect_error);
}