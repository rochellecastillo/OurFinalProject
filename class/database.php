<?php
class database{
    public $con;

    public function __construct(){
        $this->con = new mysqli("localhost","root","","TalentForce");
    }
}
?>