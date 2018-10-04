<?php
include '../db/dbconnection.php';
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: /administration');
    exit;
} else {
    echo "Error deleting record";
}