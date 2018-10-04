<?php
require_once '../db/getCoursDb.php';

if (isset($_POST['state'])) {
    if ($_POST['state'] == 1) {
        $coursesList = getCourseList();
        echo json_encode($coursesList);
    }else{
        if($_POST['state'] == 2){
            $course_id = $_POST['id'];
            $oneCourse = getSingleCourse($course_id);
            echo json_encode($oneCourse);
        }
    }
}

