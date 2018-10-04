<?php

require_once '../db/editUserDb.php';

$user_name = $_POST['name'];
$user_email = $_POST['email'];
$user_password = $_POST['password'];
$user_phone = $_POST['phone'];
$user_role = $_POST['role'];
$user_img_url = $_POST['image_url'];
$user_id = $_POST['id'];



if (isset($_FILES['image'])) {
    $imgFile = $_FILES['image'];
    $img = updateUserImage($user_img_url, $imgFile);
}

function updateUserImage($user_img, $imgFile) {
    $file = basename($user_img, ".jpg");
    $root = '../uploads/' . $file.".jpg";

    if (move_uploaded_file($imgFile['tmp_name'], $root)) {
        return $root;
    } else {
        return "ERR";
    }
}

$ans =  editUser($user_id, $user_name, $user_email, $user_password, $user_phone, $user_role);

echo $user_img_url . " " . $file . " " .  $img . " " . $imgFile ;