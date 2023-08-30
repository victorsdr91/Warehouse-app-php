<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this temchip file, choose Tools | Temchips
 * and open the temchip in the editor.
 */

/**
 * Description of CajaNegra
 *
 * @author victo
 */
include_once 'Box.php';
class BlackBox extends Box {
     private $chip;
    function __construct($id,$height,$width,$depth,$register_date,$chip) {
        parent::__construct($id,$height,$width,$depth,'orange',$register_date);
        $this->setChip($chip);
    }
    function getChip() {
        return $this->chip;
    }

    function setChip($chip) {
        $this->chip = $chip;
    }
    public function __toString() {
        return parent::__toString()."<b>Chip:</b> $this->chip <br/>";
    }
}
