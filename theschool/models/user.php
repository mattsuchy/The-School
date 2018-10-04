<?php

class user{
    public $id;
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_phone;
    public $user_role;
    public $user_image;

    function __construct($user_name,$user_email,$user_password,$user_phone,$user_role,$user_image) {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
        $this->user_phone = $user_phone;
        $this->user_role = $user_role;
        $this->user_image = $user_image;
    }
}
