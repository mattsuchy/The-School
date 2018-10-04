<?php

require_once 'dbconnection.php';

function editCourse($course_id, $course_name, $course_description) {
    $sql = "UPDATE courses SET course_name='$course_name', course_description='$course_description' WHERE course_id = $course_id";
    $result = $GLOBALS['conn']->query($sql);
  
    if($result){
        return "OK";
    }else{
        return "err";
    }
    $GLOBALS['conn']->close();
}
