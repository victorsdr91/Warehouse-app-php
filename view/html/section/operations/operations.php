<?php
include_once "model/Shelves.php";
include_once 'model/BlackBox.php';
include_once 'model/SurpriseBox.php';
include_once 'model/SecurityBox.php';
include_once 'model/Shelf.php';
include_once 'model/Shelves_Boxes.php';
include_once 'model/BlackBox_Backup.php';
include_once 'model/SurpriseBox_Backup.php';
include_once 'model/SecurityBox_Backup.php';
include_once 'model/Inventory.php';
session_start();

if (!isset($_SESSION['boxes']['loadedFreeShelves'])) { //Checking if we have to refresh the available shelves
    $_SESSION['boxes']['loadFreeShelves'] = true;
    header("Location: controller/freeshelves_controller.php");
}
?>
<section id="section" style="width:73%;float:left;">
    <form class="operation_form" action="./controller/operations_controller.php" method="post">
        <fieldset style="text-align:center;">
            <legend><?php echo SEARCH_BOX; ?></legend>
            <input type="hidden" value="true" name="searchBox" />
            <label for="id"><?php echo CODE; ?>
                <input type="number" name="id" min="0" style="width:50px;" required/>

                <select name="type" id="type" onChange="setType();">
                    <option value="black_box" selected><?php echo BLACK_BOX; ?></option>
                    <option value="security_box"><?php echo SECURITY_BOX; ?></option>
                    <option value="surprise_box"><?php echo SURPRISE_BOX; ?></option>
                </select>
                <button type="submit"/><?php echo SUBMIT; ?></button> </label>
        </fieldset>
    </form>
    <?php
//We have included here all the possibilities from the operations we can do on the system.
    if (isset($_SESSION['operations']['boxExit'])) {
        if ($_SESSION['operations']['boxExit']) { //We need to control if the box has been deleted or not
            ?> <div class="message">  <p style="color:green;font-weight:bold;"><?php echo BOX_DELETED; ?></p> </div>
            <?php
        } else {
            ?> <div class="message">  <p style="color:red;font-weight:bold;"><?php echo BOX_DELETED_ERROR; ?></p> </div>
            <?php
        }
        if (isset($_SESSION['boxes']['loadedFreeShelves'])) { //Now we need to reload the freeshelves
            unset($_SESSION['boxes']['loadedFreeShelves']);
        }
        unset($_SESSION['operations']['boxExit']);
        
//Show the result from search a box
    } else if (isset($_SESSION['operations']['searchBox']) && isset($_SESSION['operations']['showSearchedBox'])) { 
        include_once './view/html/section/operations/boxesSearchResult.php';
        
//Show the result from search a backup box
    } else if (isset($_SESSION['operations']['searchBackupBox']) && isset($_SESSION['operations']['showSearchedBackupBox'])) { 
        include_once './view/html/section/operations/BackupBoxesSearchResult.php';
        
//Show the shelves relationship
    } else if (isset($_SESSION['operations']['shelves'])) { 
        include_once './view/html/section/operations/showShelves.php';
        
//Show the boxes relationship
    } else if (isset($_SESSION['operations']['boxes'])) { 
        include_once './view/html/section/operations/showBoxes.php';

//Show the inventory relationship
    } else if (isset($_SESSION['operations']['inventory'])) { 
        include_once './view/html/section/operations/showInventory.php';
        
//Show the recover box form
    } else if (isset($_SESSION['operations']['returnBox'])) {
        include_once './view/html/section/operations/returningBoxes.php';

//If the backup box is succesfully returned, we have to show the confirm message
    } else if (isset($_SESSION['boxesReturn']['confirm']) && isset($_SESSION['boxes']['loadedFreeShelves'])) {
        ?>
        <div class="message"><p style="color:green;font-weight:bold;"><?php echo BOX_CREATED; ?></p></div>
        <?php
        unset($_SESSION['boxesReturn']['confirm']);
        
//else we have to show the error message
    } else if (isset($_SESSION['boxesReturn']['error']) && isset($_SESSION['boxes']['loadedFreeShelves'])) {
        ?> <div class="message">
            <p><strong style="color:red;"><?php echo BOX_ERROR; ?></strong><br/>
                <?php
                echo BOX_ERROR . "'" . $_SESSION['boxesReturn']['error'] . "'";
                unset($_SESSION['boxesReturn']['error']);
                ?>
            </p></div>
    <?php }
    ?>
</section>
<aside id="aside" style="width:25.8%;float:left;" >
    <h2><?php echo ACTIONS; ?></h2>
    <a class="aside_a" href="./controller/operations_controller.php?operation=showShelves"><?php echo SHOW_SHELVES; ?></a>
    <a class="aside_a" href="./controller/operations_controller.php?operation=showBoxes"><?php echo SHOW_BOXES; ?></a>
    <a class="aside_a" href="./controller/operations_controller.php?operation=showInventory"><?php echo SHOW_INVENTORY; ?></a>
    <a class="aside_a" href="./controller/operations_controller.php?operation=boxReturn"><?php echo RETURN_BOX; ?></a>
    <br/>
    <h2><?php echo OTHER_ACTIONS; ?></h2>
    <a class="aside_a" href="#"><?php echo FORCE_SHELVES_UP; ?></a>
</aside>
<script> resetAsideHeight()</script>
<div style="clear:left;"></div>