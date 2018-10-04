<?php

require_once 'dbconnection.php';
require_once '../models/course.php';
function getCourseList(){    
    $sql = "SELECT * FROM courses";
    $result = $GLOBALS['conn']->query($sql);
    $courseArr = array();
    while ($row=$result->fetch_assoc()){
        $thisCourse = new course($row['course_name'], $row['course_description'], $row['course_image']);
        $thisCourse->course_id = $row['course_id'];
        array_push($courseArr, $thisCourse);
        
    }
    return $courseArr;
  
}
function getSingleCourse($id){
     $sql = "SELECT * FROM courses WHERE course_id = $id";
    $result = $GLOBALS['conn']->query($sql);
    $row = $result->fetch_assoc();
    $oneCourse = new course($row['course_name'], $row['course_description'], $row['course_image']);
     $oneCourse->course_id = $row['course_id'];
    return $oneCourse;
}

