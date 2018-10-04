<?php

require_once '../db/editStudentDb.php';

$student_id = $_POST['id'];
$student_name = $_POST['name'];
$student_phone = $_POST['phone'];
$student_email = $_POST['email'];
$student_image = $_POST['image_url'];


if (isset($_FILES['image'])) {
    $imgFile = $_FILES['image'];
    $img = updateStudentImage($student_image, $imgFile);
}

function updateStudentImage($studentImg, $imgFile) {
    $file = basename($studentImg, ".jpg");
    $root = '../uploads/' . $file . ".jpg";

    if (move_uploaded_file($imgFile['tmp_name'], $root)) {
        return $root;
    } else {
        return "ERR";
    }
}

$ans = editStudent($student_id, $student_name, $student_phone, $student_email);
echo $ans;
//echo $user_img_url . " " . $file . " " . $img . " " . $imgFile;
