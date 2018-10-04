<?php

require_once 'dbconnection.php';

function addCourse($course_name, $course_description, $course_image) {
    $sql = "INSERT INTO courses (course_name, course_description, course_image) VALUES(?,?,?)";
    $result = $GLOBALS['conn']->prepare($sql);
    $result->bind_param("sss", $course_name, $course_description, $course_image);
    $result->execute();

    if ($result) {
        return "OK";
    } else {
        return "ERR";
    }
   // $GLOBALS['conn']->close();
}
