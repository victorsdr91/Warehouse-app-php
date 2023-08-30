<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inventory
 *
 * @author victo
 */
class Inventory {
    private $date;
    private $shelves;
    function __construct($date, $shelves) {
        $this->date = $date;
        $this->shelves = $shelves;
    }
    function getDate() {
        return $this->date;
    }

    function getShelves() {
        return $this->shelves;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setShelves($shelves) {
        $this->shelves = $shelves;
    }

    public function __toString() {
        return "holita";
    }


    
}
