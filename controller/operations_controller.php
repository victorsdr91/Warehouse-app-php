<?php

include_once '../dao/Dao.php';
include_once '../model/BlackBox.php';
include_once '../model/SurpriseBox.php';
include_once '../model/SecurityBox.php';
include_once '../model/Shelves.php';
include_once '../model/Shelf.php';
include_once '../model/Shelves_Boxes.php';
include_once '../model/BlackBox_Backup.php';
include_once '../model/SurpriseBox_Backup.php';
include_once '../model/SecurityBox_Backup.php';
include_once '../model/Inventory.php';

session_start();
if (isset($_REQUEST['action'])) {
    $box = $_SESSION['operations']['searchBox'];
    $_SESSION['operations']['boxExit'] = DAO::boxExit($box['box'], $box['shelf']->getBox_type());
     unset($_SESSION['operations']['searchBox']);
    header("Location: ../operations.html");
} else
if (isset($_REQUEST['searchBox'])) {
    $_SESSION['operations']['searchBox'] = DAO::getBoxByType($_REQUEST['id'], $_REQUEST['type']);
    $_SESSION['operations']['showSearchedBox'] = true;
    header("Location: ../operations.html");
}
elseif (isset($_REQUEST['searchBackupBox'])) {
    $_SESSION['operations']['searchBackupBox'] = DAO::getBackupBoxByType($_REQUEST['id'], $_REQUEST['type']);
    $_SESSION['operations']['showSearchedBackupBox'] = true;
    header("Location: ../operations.html");
}
else if(isset($_REQUEST['returnBox'])) {
     try {
        try {
            unset($_SESSION['boxes']['loadedFreeShelves']);
            $shelves = DAO::getShelvesId($_REQUEST['shelves']);
            $box = $_SESSION['operations']['searchBackupBox'];
            if($box instanceof BlackBox_Backup){
                    $boxn = new BlackBox($box->getId(), $box->getHeight(), $box->getWidth(), $box->getDepth(), null, $box->getChip());
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], $box->getId(), 'black_box');
                    Dao::insertBlackBox($boxn, $shelf);
                    Dao::backupBoxDelete($box, $shelf->getBox_type());
            }else if($box instanceof SecurityBox_Backup){
                    $boxn = new SecurityBox($box->getId(), $box->getHeight(), $box->getWidth(), $box->getDepth(), $box->getColor(), null, $box->getLock());
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], $box->getId(), 'security_box');
                    Dao::insertSecurityBox($boxn, $shelf);
                    Dao::backupBoxDelete($box, $shelf->getBox_type());
            }else if($box instanceof SurpriseBox_Backup){
                    $boxn = new SurpriseBox($box->getId(), $box->getHeight(), $box->getWidth(), $box->getDepth(), $box->getColor(), null, $box->getContent());
                    $shelf = new Shelf($_REQUEST['shelves'], $_REQUEST['shelfNumber'], $box->getId(), 'surprise_box');
                    Dao::insertSurpriseBox($boxn, $shelf);
                    Dao::backupBoxDelete($box, $shelf->getBox_type());
            }
            $_SESSION['boxesReturn']['confirm'] = true;
            if (isset($_SESSION['boxes']['loadedFreeShelves'])) {
                unset($_SESSION['boxes']['loadedFreeShelves']);
            }
            header('Location: ../operations.html');
        } catch (Wrong_Dimension $error) {
            $_SESSION['boxesReturn']['error'] = (String) $error;
            header('Location: ../operations.html');
        }
    } catch (Dao_Exception $error) {
        $_SESSION['boxesReturn']['error'] = (String) $error;
        header('Location: ../operations.html');
    }
} 
else if(isset($_REQUEST['operation'])) {
    $operation = $_REQUEST['operation'];
    switch ($operation) {
        case 'showShelves': $_SESSION['operations']['shelves'] = Dao::getAllShelves();
            break;
        case 'showBoxes': $_SESSION['operations']['boxes']['surprise'] = Dao::getAllBoxes('surprise_box');
            $_SESSION['operations']['boxes']['black'] = Dao::getAllBoxes('black_box');
            $_SESSION['operations']['boxes']['security'] = Dao::getAllBoxes('security_box');
            break;
        case 'showInventory': $_SESSION['operations']['inventory'] = DAO::getInventory();
            break;
        case 'boxReturn': $_SESSION['operations']['returnBox'] = true;
            break;
    }
    header("Location: ../operations.html");
} else {
    header("Location: ../operations.html");
}


