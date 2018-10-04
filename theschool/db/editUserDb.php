<?php

require_once 'dbconnection.php';

function editUser($user_id, $user_name, $user_email, $user_password, $user_phone, $user_role) {
    $sql = "UPDATE users SET user_name='$user_name', user_email='$user_email',user_phone='$user_phone',user_password='$user_password',user_role='$user_role' WHERE id = $user_id ";
    $result = $GLOBALS['conn']->query($sql);
  
    if($result){
        return "OK";
    }else{
        return $result->error;
    }
    $GLOBALS['conn']->close();
}
