<?php

require_once '../db/logindb.php';
$user_email = $_POST ['user_email'];
$user_password = sha1($_POST ['user_password']);

$reply = login_user($user_email, $user_password);
if ($reply == FALSE) {
    echo 'User Name or Password do not match!';
}elseif ($reply==TRUE) {
    echo 'ok';
}