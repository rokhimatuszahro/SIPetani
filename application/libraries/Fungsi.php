<?php

class Fungsi{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }
}

?>