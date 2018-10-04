<?php

require_once '../db/addStudentDb.php';

$student_name = $_POST['name'];
$student_phone = $_POST['phone'];
$student_email = $_POST['email'];
$student_image = $_POST['image'];

$theStudent = addStudent($student_name, $student_phone, $student_email, $student_image);