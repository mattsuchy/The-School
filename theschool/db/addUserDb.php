<?php

require_once 'dbconnection.php';

function addUser($user_name, $user_email, $user_password, $user_phone, $user_role, $user_image) {
    $sql = "INSERT INTO users (user_name,user_email,user_phone,user_password,user_role,user_image) VALUES(?,?,?,?,?,?)";
    $result = $GLOBALS['conn']->prepare($sql);
    $result->bind_param("ssssss",$user_name, $user_email, $user_phone , $user_password, $user_role, $user_image);
    $result->execute();
    
    if($result){
        return "OK";
    }else{
        return "ERR";
    }
    $GLOBALS['conn']->close();
}


