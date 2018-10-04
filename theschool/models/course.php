<?php

class course{
    public $course_id;
    public $course_name;
    public $course_description;
    public $course_image;
    
    function __construct($course_name, $course_description, $course_image) {
        $this->course_name = $course_name;
        $this->course_description = $course_description;
        $this->course_image = $course_image;
    }
}
