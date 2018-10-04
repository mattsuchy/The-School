<?php

class student{
    public $student_id;
    public $student_name;
    public $student_phone;
    public $student_email;
    public $student_image;
    function __construct($student_name, $student_phone, $student_email, $student_image) {
        $this->student_name = $student_name;
        $this->student_phone = $student_phone;
        $this->student_email = $student_email;
        $this->student_image = $student_image;
    }

}