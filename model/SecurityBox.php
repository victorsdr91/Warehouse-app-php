<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaSeguridad
 *
 * @author victo
 */
include_once 'Box.php';
class SecurityBox extends Box{
    private $lock;
    function __construct($id,$height,$width,$depth,$color,$register_date,$lock) {
        parent::__construct($id,$height,$width,$depth,$color,$register_date);
        $this->setLock($lock);
    }
    function getLock() {
        return $this->lock;
    }

    function setLock($code) {
        $this->lock = $code;
    }
    public function __toString() {
        return parent::__toString()."<b>Lock:</b> $this->lock <br/>";
    }

}
