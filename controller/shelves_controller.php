<?php

include_once '../model/Shelves.php';
include_once '../dao/Dao.php';

session_start();
if (isset($_REQUEST['nshelf']) && isset($_REQUEST['material']) && isset($_REQUEST['corridor']) && isset($_REQUEST['position'])) {
    try {
        $shelves = new Shelves(0, $_REQUEST['nshelf'], 0, $_REQUEST['material'], $_REQUEST['corridor'], $_REQUEST['position']);
        Dao::insertShelves($shelves);
        $_SESSION['shelves']['confirm'] = true;
        if (isset($_SESSION['boxes']['loadedFreeShelves'])) {
            unset($_SESSION['boxes']['loadedFreeShelves']);
        }
        header('Location: ../shelves.html');
    } catch (Dao_Exception $error) {
        $_SESSION['shelves']['error'] = (String) $error;
        header('Location: ../shelves.html');
    }
}

