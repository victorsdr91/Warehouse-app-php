<?php

include_once '../dao/Dao.php';
include_once '../model/BlackBox.php';
include_once '../model/SurpriseBox.php';
include_once '../model/SecurityBox.php';
include_once '../model/Shelves.php';
include_once '../model/Shelf.php';

session_start();

if (isset($_REQUEST['shelves'])) {//If we have a request of shelves, we have the rest of requests to create a box.
    try {
        try {
            unset($_SESSION['boxes']['loadedFreeShelves']);
            $shelves = DAO::getShelvesId($_REQUEST['shelves']);
            switch ($_REQUEST['type']) {
                case 'black_box':
                    $box = new BlackBox(0, $_REQUEST['boxHeight'], $_REQUEST['boxWidth'], $_REQUEST['boxDepth'], null, $_REQUEST['boxChip']);
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], 0, $_REQUEST['type']);
                    Dao::insertBlackBox($box, $shelf);
                    break;
                case 'security_box':
                    $box = new SecurityBox(0, $_REQUEST['boxHeight'], $_REQUEST['boxWidth'], $_REQUEST['boxDepth'], $_REQUEST['boxColor'], null, $_REQUEST['boxLock']);
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], 0, $_REQUEST['type']);
                    Dao::insertSecurityBox($box, $shelf);
                    break;
                case 'surprise_box':
                    $box = new SurpriseBox(0, $_REQUEST['boxHeight'], $_REQUEST['boxWidth'], $_REQUEST['boxDepth'], $_REQUEST['boxColor'], null, $_REQUEST['boxContent']);
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], 0, $_REQUEST['type']);
                    Dao::insertSurpriseBox($box, $shelf);
                    break;
            }
            $_SESSION['boxes']['confirm'] = true;
            if (isset($_SESSION['boxes']['loadedFreeShelves'])) {
                unset($_SESSION['boxes']['loadedFreeShelves']);
            }
            header('Location: ../boxes.html');
        } catch (Wrong_Dimension $error) {
            $_SESSION['boxes']['error'] = (String) $error;
            header('Location: ../boxes.html');
        }
    } catch (Dao_Exception $error) {
        $_SESSION['boxes']['error'] = (String) $error;
        header('Location: ../boxes.html');
    }
} 
