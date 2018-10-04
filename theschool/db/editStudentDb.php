<?php

require_once 'dbconnection.php';

function editStudent($student_name, $student_phone, $student_email) {
    $sql = "UPDATE student SET student_name='$student_name', student_phone='$student_phone', student_email='$student_email' WHERE student_id = $student_id";
    $result = $GLOBALS['conn']->query($sql);
  
    if($result){
        return "OK";
    }else{
        return "err";
    }
    $GLOBALS['conn']->close();
}