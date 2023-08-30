<?php

include_once 'dbconnect.php';
include_once 'Dao_Exception.php';

class Dao {
    /**
     * Function insertShelves
     * Insert a new Shelves object on the data base
     *  @param $shelve Shelves
     *          Object to insert in the database
     */

    public static function insertShelves($shelve) {
        global $connect;
        if ($shelve instanceof Shelves) {
            if (Dao::getShelves($shelve->getCorridor(), $shelve->getPosition()) instanceof Shelves) {
                throw new Dao_Exception('Shelves', 1);
            } else {
                $insert = "INSERT INTO shelves (SHELF_NUMBER,MATERIAL,CORRIDOR,POSITION) "
                        . "VALUES ('" . $shelve->getNshelves() . "','" . $shelve->getMaterial() . "',UPPER('" . $shelve->getCorridor() . "'),'" . $shelve->getPosition() . "')";
                $result = $connect->query($insert);
                if (!$result) {
                    throw new Dao_Exception('Shelves', 2);
                }
                mysqli_free_result($result);
            }
        } else {
            throw new Dao_Exception('Shelves', 3);
        }
    }

    /**
     * Function getShelves
     * Return an Shelves Object
     *  @param $corridor Char 
     *          Corridor where are the shelves
     *  @param $position Int
     *          Position on the corridor where are the shelves
     *  @return $shelves Shelves
     */

    public static function getShelves($corridor, $position) {
        global $connect;
        $select = "SELECT * FROM shelves WHERE CORRIDOR=UPPER('$corridor') AND POSITION=$position";
        $result = $connect->query($select);
        if (!$result) {
            throw new Dao_Exception('Shelves', 4);
        } else {
            $row = $result->fetch_array();
            if ($row) {
                $shelves = new Shelves($row['ID'], $row['SHELF_NUMBER'], $row['OCCUPIED'], $row['MATERIAL'], $row['CORRIDOR'], $row['POSITION']);
                mysqli_free_result($result);
                return $shelves;
            } else {
                return false;
            }
        }
    }

    /**
     * Function getShelvesId
     * Return an Shelves Object
     *  @param $id Integer 
     *          ID from shelves to get on the database
     *  @return $shelve Shelves
     */

    public static function getShelvesId($id) {
        global $connect;
        $select = "SELECT * FROM shelves WHERE ID = $id";
        $result = $connect->query($select);
        if (!$result) {
            throw new Dao_Exception('Shelves', 4);
        } else {
            $row = $result->fetch_array();
            if ($row) {
                $shelve = new Shelves($row['ID'], $row['SHELF_NUMBER'], $row['OCCUPIED'], $row['MATERIAL'], $row['CORRIDOR'], $row['POSITION']);
                mysqli_free_result($result);
                return $shelve;
            } else {
                return false;
            }
        }
    }

    /**
     * Function getAllShelves
     * Return a Shelves Array ordered by corridor and position
     *  @return $shelves Array
     */

    public static function getAllShelves() {
        global $connect;
        $select = "SELECT * FROM shelves ORDER BY CORRIDOR,POSITION asc";
        $result = $connect->query($select);
        while ($row = $result->fetch_array()) {
            $shelves[$row['ID']] = new Shelves($row['ID'], $row['SHELF_NUMBER'], $row['OCCUPIED'], $row['MATERIAL'], $row['CORRIDOR'], $row['POSITION']);
        }
        mysqli_free_result($result);
        return $shelves;
    }

    /**
     * Function getFreeShelves
     * Return a free Shelves Array
     *  
     *  @return $shelve Shelves
     */

    public static function getFreeShelves() {
        global $connect;
        $select = "SELECT * FROM shelves WHERE OCCUPIED<SHELF_NUMBER ORDER BY CORRIDOR,POSITION asc";
        $result = $connect->query($select);
        while ($row = $result->fetch_array()) {
            $shelves[$row['ID']] = new Shelves($row['ID'], $row['SHELF_NUMBER'], $row['OCCUPIED'], $row['MATERIAL'], $row['CORRIDOR'], $row['POSITION']);
        }
        mysqli_free_result($result);

        return $shelves;
    }

    /**
     * Function getOccupiedShelves
     * Return an occupied Shelves Array
     *  
     *  @return $shelves Shelves
     */

    public static function getOccupiedShelves() {
        global $connect;
        $select = "SELECT * FROM shelves WHERE OCCUPIED>0 ORDER BY CORRIDOR,POSITION asc";
        $result = $connect->query($select);
        while ($row = $result->fetch_array()) {
            $shelves[$row['ID']] = new Shelves($row['ID'], $row['SHELF_NUMBER'], $row['OCCUPIED'], $row['MATERIAL'], $row['CORRIDOR'], $row['POSITION']);
        }
        mysqli_free_result($result);

        return $shelves;
    }

    /**
     * Function getShelfArray
     * 
     * Return an Array with all racks on determinated shelves
     * 
     *  @param Shelves $shelves Shelves 
     * 
     *  @return Array $shelf
     */

    public static function getShelfArray($shelves) {
        global $connect;
        if ($shelves instanceof Shelves) {
            $shelf = array();
            for ($i = 1; $i <= $shelves->getNshelves(); $i++) {
                $shelf[$i] = null;
            }
            $select = "SELECT * FROM occupated_shelves WHERE shelves_id='" . $shelves->getId() . "' ";
            $result = $connect->query($select);
            if ($result) {
                while ($row = $result->fetch_object()) {
                    $shelf[$row->shelf_id] = new Shelf($row->shelves_id, $row->shelf_id, $row->box_id, $row->box_type);
                }
            }
            return $shelf;
        }
    }

    /**
     * Function insertBlackBox
     * Insert a new Black Box object on the data base
     *  @param $box Black Box
     *          Object to insert in the database
     */

    public static function insertBlackBox($box, $shelf) {
        global $connect;
        if ($box instanceof BlackBox && $shelf instanceof Shelf) {
            $connect->autocommit(false);
            $shelves_id = $shelf->getShelves_id();
            $shelf_id = $shelf->getShelf_id();
            $box_type = $shelf->getBox_type();
            if($box->getId()==0) $id='null';
            else $id = $box->getId();
            $connect->autocommit(false);
            $insertbox = "INSERT INTO black_box (ID,WIDTH,HEIGHT,DEPTH,CHIP,REGISTER_DATE) "
                    . "VALUES ($id,'" . $box->getWidth() . "', '" . $box->getHeight() . "', '" . $box->getDepth() . "', '" . $box->getChip() . "','" . date('Y-m-d') . "' )";
            $update = "UPDATE shelves SET OCCUPIED=OCCUPIED+1 WHERE ID='" . $shelf->getShelves_id() . "'";
            if (!$connect->query($update)) {
                $connect->rollback();
                throw new Dao_Exception('Black Box', 2);
            }
            if (!$connect->query($insertbox)) {
                $connect->rollback();
                throw new Dao_Exception('Black Box', 2);
            }
            $box_id = ($connect->insert_id);
            $insertshelf = "INSERT INTO occupated_shelves VALUES ('$shelves_id', '$shelf_id', '$box_id', '$box_type')";
            if (!$connect->query($insertshelf)) {
                $connect->rollback();
                throw new Dao_Exception('Black Box', 2);
            }
            $connect->commit();
        } else {
            throw new Dao_Exception('Black Box', 3);
        }
    }

    /**
     * Function insertSurpriseBox
     * Insert a new Surprise Box object on the data base
     *  @param $box SurpriseBox
     *          Object to insert in the database
     */

    public static function insertSurpriseBox($box, $shelf) {
        global $connect;
        if ($box instanceof SurpriseBox && $shelf instanceof Shelf) {
            $connect->autocommit(false);
            $shelves_id = $shelf->getShelves_id();
            $shelf_id = $shelf->getShelf_id();
            $box_type = $shelf->getBox_type();
            if($box->getId()==0) $id='null';
            else $id = $box->getId();
            $insertbox = "INSERT INTO surprise_box VALUES ($id,'" . $box->getWidth() . "','" . $box->getHeight() . "','" . $box->getDepth() . "','" . $box->getColor() . "','" . $box->getContent() . "','" . date("Y-m-d") . "')";
            $update = "UPDATE shelves SET OCCUPIED=OCCUPIED+1 WHERE ID='" . $shelf->getShelves_id() . "'";
                
            if (!$connect->query($update)) {
                $connect->rollback();
                throw new Dao_Exception('Surprise Box', 2);
            }
            if (!$connect->query($insertbox)) {
                $connect->rollback();
                throw new Dao_Exception('Surprise Box', 2);
            }
            $box_id = ($connect->insert_id);
            $insertshelf = "INSERT INTO occupated_shelves VALUES ('$shelves_id', '$shelf_id', '$box_id', '$box_type')";
            if (!$connect->query($insertshelf)) {
                $connect->rollback();
                throw new Dao_Exception('Surprise Box', 2);
            }
            $connect->commit();
        } else {
            throw new Dao_Exception('Surprise Box', 3);
        }
    }

    /**
     * Function insertSecurityBox
     * Insert a new Security Box object on the data base
     *  @param $box SecurityBox
     *          Object to insert in the database
     */

    public static function insertSecurityBox($box, $shelf) {
        global $connect;
        if ($box instanceof SecurityBox && $shelf instanceof Shelf) {
            $connect->autocommit(false);
            $shelves_id = $shelf->getShelves_id();
            $shelf_id = $shelf->getShelf_id();
            $box_type = $shelf->getBox_type();
            if($box->getId()==0) $id='null';
            else $id = $box->getId();
            $insertbox = "INSERT INTO security_box VALUES ($id,'" . $box->getWidth() . "','" . $box->getHeight() . "','" . $box->getDepth() . "','" . $box->getColor() . "','" . $box->getLock() . "','" . date('Y-m-d') . "' )";
            $update = "UPDATE shelves SET OCCUPIED=OCCUPIED+1 WHERE ID='" . $shelf->getShelves_id() . "'";

            if (!$connect->query($update)) {
                $connect->rollback();
                throw new Dao_Exception('Security Box', 2);
            }
            if (!$connect->query($insertbox)) {
                $connect->rollback();
                throw new Dao_Exception('Security Box', 2);
            }
            $box_id = ($connect->insert_id);
            $insertshelf = "INSERT INTO occupated_shelves VALUES ('$shelves_id', '$shelf_id', '$box_id', '$box_type')";
            if (!$connect->query($insertshelf)) {
                $connect->rollback();
                throw new Dao_Exception('Security Box', 1);
            }
            $connect->commit();
        } else {
            throw new Dao_Exception('Security Box', 3);
        }
    }

    /**
     * Function getBoxByType
     * Get a box from database by type and id
     *  @param $id int
     *          id from box.
     *  @param $type String
     *          type from box 
     *  @return $box
     *          Box object getted from database
     */
    public static function getBoxByType($id, $type) {
        global $connect;
        $selectBox = "SELECT * FROM $type WHERE id='$id' ";
        $resultBox = $connect->query($selectBox);
        if ($box_row = $resultBox->fetch_object()) {
            $selectShelf = "SELECT * FROM occupated_shelves WHERE box_id='$id' AND box_type='$type' ";
            $resultShelf = $connect->query($selectShelf);
            $shelf_row = $resultShelf->fetch_object();
            switch ($type) {
                case 'black_box':
                    $box['box'] = new BlackBox($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->REGISTER_DATE, $box_row->CHIP);
                    break;
                case 'security_box':
                    $box['box'] = new SecurityBox($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->COLOR, $box_row->REGISTER_DATE, $box_row->LOCK);
                    break;
                case 'surprise_box':
                    $box['box'] = new SurpriseBox($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->COLOR, $box_row->REGISTER_DATE, $box_row->CONTENT);
                    break;
            }
            $box['shelf'] = new Shelf($shelf_row->shelves_id, $shelf_row->shelf_id, $shelf_row->box_id, $shelf_row->box_type);
            mysqli_free_result($resultBox);
            mysqli_free_result($resultShelf);
            return $box;
        } else {
            return false;
        }
    }
    /**
     * Function getBoxByShelf
     * Get a box from database by type and id
     *  @param $shelf Shelf
     *          Shelf object to get the box on it.
     *  @return $box
     *          Box object getted from database
     */
    public static function getBoxByShelf($shelf) {
        global $connect;
        if ($shelf instanceof Shelf) {
            $select = "SELECT * FROM " . $shelf->getBox_type() . " WHERE id='" . $shelf->getBox_id() . "' ";
            //print_r($shelves);
            $result = $connect->query($select);
            if (!$result) {
                throw new Dao_Exception('Box', 4);
            } else {
                while ($row = $result->fetch_object()) {
                    switch ($shelf->getBox_type()) {
                        case 'black_box':
                            $box = new BlackBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->REGISTER_DATE, $row->CHIP);
                            break;
                        case 'security_box':
                            $box = new SecurityBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->COLOR, $row->REGISTER_DATE, $row->LOCK);
                            break;
                        case 'surprise_box':
                            $box = new SurpriseBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->COLOR, $row->REGISTER_DATE, $row->CONTENT);
                            break;
                    }
                }
                mysqli_free_result($result);
                return $box;
            }
        }
    }

    /**
     * Function getAllBoxes
     * Return an Array with all boxes 
     *  @param $type string 
     *          Type from the box to get on the database
     *  @return $boxes Array
     */

    public static function getAllBoxes($type) {
        global $connect;
        $select = "SELECT * FROM $type ";
        $result = $connect->query($select);
        if (!$result) {
            throw new Dao_Exception('Box', 4);
        } else {
            while ($row = $result->fetch_object()) {
                $selectShelf = "SELECT * FROM occupated_shelves WHERE box_id=$row->ID AND box_type='$type' ";
                $resultShelf = $connect->query($selectShelf);
                $shelfRow = $resultShelf->fetch_object();
                $shelf = new Shelf($shelfRow->shelves_id, $shelfRow->shelf_id, $shelfRow->box_id, $shelfRow->box_type);
                switch ($type) {
                    case 'black_box':
                        $box = new BlackBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->REGISTER_DATE, $row->CHIP);
                        break;
                    case 'security_box':
                        $box = new SecurityBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->COLOR, $row->REGISTER_DATE, $row->LOCK);
                        break;
                    case 'surprise_box':
                        $box = new SurpriseBox($row->ID, $row->HEIGHT, $row->WIDTH, $row->DEPTH, $row->COLOR, $row->REGISTER_DATE, $row->CONTENT);
                        break;
                }
                mysqli_free_result($resultShelf);
                $boxes[$row->ID]['shelf'] = $shelf;
                $boxes[$row->ID]['box'] = $box;
            }
            mysqli_free_result($result);
            return $boxes;
        }
    }
    
    /**
     * Function getShelvesBoxes
     * Return an Array with all boxes 
     *  @param $shelves Shelves 
     *          Shelves object to create the Shelves_Boxes object
     *  @return $shelvesBox Shelves_Boxes
     */
    public static function getShelvesBoxes($shelves) {
        if ($shelves instanceof Shelves) {
            global $connect;
            $boxes = array();
            for ($i = 1; $i <= $shelves->getNshelves(); $i++) {
                $boxes[$i] = null;
            }
            $select = "SELECT * FROM occupated_shelves WHERE shelves_id='" . $shelves->getId() . "'";
            $result = $connect->query($select);
            while ($row = $result->fetch_object()) {
                $shelf = new Shelf($row->shelves_id, $row->shelf_id, $row->box_id, $row->box_type);
                $boxes[$row->shelf_id] = DAO::getBoxByShelf($shelf);
            }
            mysqli_free_result($result);
            $shelvesBox = new Shelves_Boxes($shelves->getId(), $shelves->getNshelves(), $shelves->getOccupied(), $shelves->getMaterial(), $shelves->getCorridor(), $shelves->getPosition(), $boxes);
            return $shelvesBox;
        }
    }

    /**
     * Function getInventory
     * return an Inventory object
     * @return $inventory Inventory
     */
    public static function getInventory() {
        $date = getdate();
        $date = $date['mon'] . "-" . $date['mday'] . "-" . $date['year'];
        $shelves = DAO::getOccupiedShelves();
        $i = 0;
        foreach ($shelves as $shelf) {
            $inv_shelves[$i] = DAO::getShelvesBoxes($shelf);
            $i++;
        }
        $inventory = new Inventory($date, $inv_shelves);
        return $inventory;
    }

    
    /**
     * Function boxExit
     * Deletes a box from the database
     * @param Box $box 
     * @param String $type
     * @return boolean
     */
    public static function boxExit($box, $type) {
        global $connect;
        $query = "DELETE FROM $type WHERE ID=" . $box->getId();
        $result = $connect->query($query);
        return $result;
    }
    
    /**
     * backupBoxDelte
     * Deletes a backup box from the database
     * @param Box $box
     * @param String $type
     */
    public static function backupBoxDelete($box, $type) {
        global $connect;
        $tipo= $type."_backup";
        print_r($box);
        $query = "DELETE FROM $tipo WHERE ID=".$box->getId();
        $result = $connect->query($query);
        $connect->commit();
    }
    
     /**
     * Function getBackupBoxByType
     * Get a backup box from database by type and id
     *  @param $id int
     *          id from box.
     *  @param $type String
     *          type from box 
     *  @return $box
     *          Box object getted from database
     */
    public static function getBackupBoxByType($id, $type) {
        global $connect;
        $selectBox = "SELECT * FROM ".$type."_backup WHERE id='$id' ";
        $resultBox = $connect->query($selectBox);
        if ($box_row = $resultBox->fetch_object()) {
            switch ($type) {
                case 'black_box':
                    $box = new BlackBox_Backup($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->REGISTER_DATE, $box_row->CHIP, $box_row->DISCHARGE_DATE, $box_row->SHELVES_ID, $box_row->SHELF_ID);
                    break;
                case 'security_box':
                    $box = new SecurityBox_Backup($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->COLOR, $box_row->REGISTER_DATE, $box_row->LOCK, $box_row->DISCHARGE_DATE, $box_row->SHELVES_ID, $box_row->SHELF_ID);
                    break;
                case 'surprise_box':
                    $box = new SurpriseBox_Backup($box_row->ID, $box_row->HEIGHT, $box_row->WIDTH, $box_row->DEPTH, $box_row->COLOR, $box_row->REGISTER_DATE, $box_row->CONTENT, $box_row->DISCHARGE_DATE, $box_row->SHELVES_ID, $box_row->SHELF_ID);
                    break;
            }
            mysqli_free_result($resultBox);
            return $box;
        } else {
            return false;
        }
    }
}
