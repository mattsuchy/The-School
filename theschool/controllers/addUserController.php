<?php

require_once '../db/addUserDb.php';

$user_name = $_POST['name'];
$user_email = $_POST['email'];
$user_password = sha1($_POST['password']);
$user_phone = $_POST['phone'];
$user_role = $_POST['role'];
$user_img = $_POST['image'];

$theuser=addUser($user_name, $user_email, $user_password, $user_phone, $user_role, $user_img);

 


