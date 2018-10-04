<?php

session_start();
require_once 'dbconnection.php';
require_once '../models/user.php';

function login_user($useremail, $pass) {
    $sql = "SELECT count(*) AS total FROM users WHERE user_email = '$useremail' AND user_password = '$pass'";
    $result = $GLOBALS['conn']->query($sql);
    $row = $result->fetch_assoc();
    if ($row['total'] == 1) {
        $sql = "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$pass'";
        $result = $GLOBALS['conn']->query($sql);
        $row = $result->fetch_assoc();
        $currentLogin = new user($row['user_name'], $row['user_email'], $row['user_password'], $row['user_phone'], $row['user_role'], $row['user_image']);
        switch($currentLogin->user_role){
            case "owner":
                $_SESSION['owner'] = serialize($currentLogin);
                break;
            case "manager":
                $_SESSION['manager'] = serialize($currentLogin);
                break;
            case "sales":
                $_SESSION['sales'] = serialize($currentLogin);
                break;
        }
    }else{
        return FALSE;
    }
    return true;
}
