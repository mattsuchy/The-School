<?php

require_once 'dbconnection.php';

function addStudent($student_name, $student_phone, $student_email, $student_image) {
    $sql = "INSERT INTO student (student_name, student_phone, student_email, student_image) VALUES(?,?,?,?)";
    $result = $GLOBALS['conn']->prepare($sql);
    $result->bind_param("ssss", $student_name, $student_phone, $student_email, $student_image);
    $result->execute();

    if ($result) {
        return "OK";
    } else {
        return "ERR";
    }
 $GLOBALS['conn']->close();
}