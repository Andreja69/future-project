<?php
class Sessions {

    public static function flash($key,$value)
    {
        $_SESSION[$key] = $value;
    }
}

