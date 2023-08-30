<?php
include_once '../dao/Dao.php';
include_once '../model/BlackBox.php';
include_once '../model/SurpriseBox.php';
include_once '../model/SecurityBox.php';
include_once '../model/Shelves.php';
include_once '../model/Shelf.php';

session_start();

if (isset($_SESSION['boxes']['loadFreeShelves'])) {//If we want to reload the available shelves
    try {
        if (isset($_SESSION['boxes']['freeshelves'])) {
            unset($_SESSION['boxes']['freeshelves']);
        }
        $_SESSION['boxes']['freeshelves'] = Dao::getFreeShelves();
        unset($_SESSION['boxes']['loadFreeShelves']);
        $_SESSION['boxes']['loadedFreeShelves'] = true;
        header("Location: ".$_SERVER['HTTP_REFERER']);
    } catch (Dao_Exception $error) {
        $_SESSION['boxes']['error'] = (String) $error;
        unset($_SESSION['boxes']['loadFreeShelves']);
        $_SESSION['boxes']['loadedFreeShelves'] = false;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}

else if (isset($_REQUEST['loadShelfNumber'])) {
    $shelves = $_SESSION['boxes']['freeshelves'];
    $shelfArray = DAO::getShelfArray($shelves[$_REQUEST['loadShelfNumber']]);
    foreach ($shelfArray as $val => $val2) {
        if ($val2 == null) {
            echo "<option>$val</option>";
        }
    }
}