<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caja
 *
 * @author Victor
 */
include "Wrong_Dimension.php";
abstract class Box {
    private $id;
    private $height;
    private $width;
    private $depth;
    private $color;
    private $register_date;
    
    //constructor
    function __construct($id, $height, $width, $depth, $color, $register_date) {
        $this->setId($id);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setDepth($depth);
        $this->setColor($color);
        $this->setRegister_date($register_date);
    }
    function getRegister_date() {
        return date("m-d-Y",strtotime($this->register_date));
    }

    function setRegister_date($register_date) {
        $this->register_date = $register_date;
    }

        function getId() {
        return $this->id;
    }

    function getShelvesId() {
        return $this->shelvesId;
    }

    function getShelf() {
        return $this->shelf;
    }

    private function setId($id) {
        $this->id = $id;
    }

    private function setShelvesId($shelvesId) {
        $this->shelvesId = $shelvesId;
    }

    private function setShelf($shelf) {
        $this->shelf = $shelf;
    }

        
    function getHeight() {
        return $this->height;
    }

    function getWidth() {
        return $this->width;
    }

    function getDepth() {
        return $this->depth;
    }
    function setHeight($height) {
        if($height < 0 ) {
            throw new Wrong_Dimension("Height", 1);
        }else if($height > 10000){
            throw new Wrong_Dimension("Height", 2);
        }
        else if($height == 0){
             throw new Wrong_Dimension("Height", 3);
        }
        else {
            $this->height = $height;
        }
    }

    function setWidth($width) {
        if($width < 0 ) {
            throw new Wrong_Dimension("Width", 1);
        }else if($width > 10000){
            throw new Wrong_Dimension("Width", 2);
        }
        else if($width == 0){
             throw new Wrong_Dimension("Width", 3);
        }else {
            $this->width = $width;
        }
    }

    function setDepth($depth) {
           if($depth < 0 ) {
            throw new Wrong_Dimension("Depth", 1);
        }else if($depth> 10000){
            throw new Wrong_Dimension("Depth", 2);
        } else if($depth == 0){
             throw new Wrong_Dimension("Depth", 3);
        } else {
            $this->depth = $depth;
        }
    }
        
    public function __toString() {
        return "<b>Id:</b> $this->id <br/> "
                . "<b>Shelves ID:</b> $this->shelvesId <br/>"
                . "<b>Shelf:</b> $this->shelf <br/>  "
                . "<b>Height:</b> $this->height <br/> "
                . "<b>Width:</b> $this->width <br/> "
                . "<b>Depth:</b> $this->depth <br/> "
                . "<b>Color:</b> $this->color<br/>";
    }
    function getColor() {
        return $this->color;
    }

    function setColor($color) {
        $this->color = $color;
    }

}
