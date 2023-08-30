<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shelf_Class
 *
 * @author victo
 */
class Shelves {
        private $id;
        private $nshelves;
        private $occupied;
        private $material;
        private $corridor;
        private $position;
//        function __construct($id, $nshelves, $occupied, $material, $corridor, $position) {
//            $this->setId($id);
//            $this->setNshelves($nshelves);
//            $this->setOccupied($occupied);
//            $this->setMaterial($material);
//            $this->setCorridor($corridor);
//            $this->setPosition($position);
//        }
    function __construct($id, $nshelves, $occupied, $material, $corridor, $position) {
        $this->id = $id;
        $this->nshelves = $nshelves;
        $this->occupied = $occupied;
        $this->material = $material;
        $this->corridor = $corridor;
        $this->position = $position;
    }

    function getId() {
            return $this->id;
        }

        function getOccupied() {
            return $this->occupied;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setOccupied($occupied) {
            $this->occupied = $occupied;
        }

        function getNshelves() {
            return $this->nshelves;
        }

        function getMaterial() {
            return $this->material;
        }

        function getCorridor() {
            return $this->corridor;
        }

        function getPosition() {
            return $this->position;
        }

        function setNshelves($nshelves) {
            $this->nshelves = $nshelves;
        }

        function setMaterial($material) {
            $this->material = $material;
        }

        function setCorridor($corridor) {
            $this->corridor = $corridor;
        }

        function setPosition($position) {
            $this->position = $position;
        }

        public function __toString() {
            return "<br/><b>Shelves $this->id</b><br/>"
                    . "Shelf Number: $this->nshelves<br/>"
                    . "Occupied: $this->nshelves<br/>"
                    . "Material: $this->material<br/>"
                    . "Corridor: $this->corridor<br/>"
                    . "Position: $this->position<br/>";
        }


}
