<?php
require_once '../db/getStudentDb.php';

if (isset($_POST['state'])) {
    if ($_POST['state'] == 1) {
        $studentList = getStudentList();
        echo json_encode($studentList);
    }else{
        if($_POST['state'] == 2){
            $student_id = $_POST['id'];
            $oneStudent = getSingleStudent($student_id);
            echo json_encode($oneStudent);
        }
    }
}