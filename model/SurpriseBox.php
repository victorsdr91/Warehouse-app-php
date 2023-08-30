<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CajaContent
 *
 * @author victo
 */
include_once "Box.php";
class SurpriseBox extends Box {
    private $content;
    function __construct($id,$height,$width,$depth,$color,$register_date,$content) {
        parent::__construct($id,$height,$width,$depth,$color,$register_date); 
        $this->setContent($content);
    }
    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }
    public function __toString() {
        return parent::__toString()."<b>Content:</b> $this->content<br/>";
    }


}
