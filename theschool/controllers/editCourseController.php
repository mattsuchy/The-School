<?php

require_once '../db/editCourseDb.php';

$course_id = $_POST['id'];
$course_name = $_POST['name'];
$course_description = $_POST['description'];
$course_image = $_POST['image_url'];


if (isset($_FILES['image'])) {
    $imgFile = $_FILES['image'];
    $img = updateCourseImage($course_image, $imgFile);
}

function updateCourseImage($courseImg, $imgFile) {
    $file = basename($courseImg, ".jpg");
    $root = '../uploads/' . $file . ".jpg";

    if (move_uploaded_file($imgFile['tmp_name'], $root)) {
        return $root;
    } else {
        return "ERR";
    }
}

$ans = editCourse($course_id, $course_name, $course_description);
echo $ans;
//echo $user_img_url . " " . $file . " " . $img . " " . $imgFile;
