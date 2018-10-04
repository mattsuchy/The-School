<?php

require_once 'dbconnection.php';
require_once '../models/user.php';
function getAdminsList(){    
    $sql = "SELECT * FROM users";
    $result = $GLOBALS['conn']->query($sql);
    $adminsArr = array();
    while ($row=$result->fetch_assoc()){
        $thisUser = new user($row['user_name'], $row['user_email'], $row['user_password'], $row['user_phone'], $row['user_role'], $row['user_image']);
        $thisUser->id = $row['id'];
        array_push($adminsArr, $thisUser);
    }
    return $adminsArr;
  
}

function getSingleAdmin($id){
     $sql = "SELECT * FROM users WHERE id = $id";
    $result = $GLOBALS['conn']->query($sql);
    $row = $result->fetch_assoc();
    
    $oneAdmin = new user($row['user_name'], $row['user_email'], $row['user_password'], $row['user_phone'], $row['user_role'], $row['user_image']);
     $oneAdmin->id = $row['id'];
    return $oneAdmin;
}

