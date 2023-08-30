<?php

class Shelf {
    private $shelves_id;
    private $shelf_id;
    private $box_id;
    private $box_type;
    function __construct($shelves_id, $shelf_id, $box_id, $box_type) {
        $this->shelves_id = $shelves_id;
        $this->shelf_id = $shelf_id;
        $this->box_id = $box_id;
        $this->box_type = $box_type;
    }
    function getShelves_id() {
        return $this->shelves_id;
    }

    function getShelf_id() {
        return $this->shelf_id;
    }

    function getBox_id() {
        return $this->box_id;
    }

    function getBox_type() {
        return $this->box_type;
    }

    function setShelves_id($shelves_id) {
        $this->shelves_id = $shelves_id;
    }

    function setShelf_id($shelf_id) {
        $this->shelf_id = $shelf_id;
    }

    function setBox_id($box_id) {
        $this->box_id = $box_id;
    }

    function setBox_type($box_type) {
        $this->box_type = $box_type;
    }

}
