<?php

require_once 'dbconnection.php';
require_once '../models/student.php';

function getStudentList() {
    $sql = "SELECT * FROM student";
    $result = $GLOBALS['conn']->query($sql);
    $studentsArr = array();
    while ($row = $result->fetch_assoc()) {
        $thisStudent = new student($row['student_name'], $row['student_phone'], $row['student_email'], $row['student_image']);
        $thisStudent->student_id = $row['student_id'];
        array_push($studentsArr, $thisStudent);
    }
    return $studentsArr;
}

function getSingleStudent($id) {
    $sql = "SELECT * FROM student WHERE student_id = $id";
    $result = $GLOBALS['conn']->query($sql);
    $row = $result->fetch_assoc();
    $oneStudent = new student($row['student_name'], $row['student_phone'], $row['student_email'], $row['student_image']);
    $oneStudent->student_id = $row['student_id'];
    return $oneStudent;
}
