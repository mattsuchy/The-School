<?php

require_once '../db/getAdminDb.php';


if (isset($_POST['state'])) {
    if ($_POST['state'] == 1) {
        $adminsList = getAdminsList();
        echo json_encode($adminsList);
    }else{
        if($_POST['state'] == 2){
            $user_id = $_POST['id'];
            $oneAdmin = getSingleAdmin($user_id);
            echo json_encode($oneAdmin);
        }
    }
}
