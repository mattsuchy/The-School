<?php

require_once '../db/addCourseDb.php';

$course_name = $_POST['name'];
$course_description = $_POST['description'];
$course_image = $_POST['image'];

$theCourse = addCourse($course_name, $course_description, $course_image);
