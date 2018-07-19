<?php

class Exercise {

    var $exercise;
    function set_exercise($new_exercise)
    {
        $this->exercise = $new_exercise;
    }
    function get_exercise()
    {
        return $this->exercise;
    }

}