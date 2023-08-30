<?php

class Shelves_Boxes extends Shelves {
    private $boxes;
    function __construct($id, $nshelves, $occupied, $material, $corridor, $position, $boxes) {
        parent::__construct($id, $nshelves, $occupied, $material, $corridor, $position);
        $this->boxes = $boxes;
    }
    function getBoxes() {
        return $this->boxes;
    }

    function setBoxes($boxes) {
        $this->boxes = $boxes;
    }
    public function __toString() {
        $string=parent::__toString();
        foreach($this->boxes as $box){
            $string+="</br>".$box;
        }
        return $string;
    }



}
