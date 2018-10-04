<?php
include '../db/dbconnection.php';
$id = $_GET['id'];
$sql = "DELETE FROM courses WHERE course_id = $id";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: /school');
    exit;
} else {
    echo "Error deleting record";
}