<?php
include_once "model/Shelves.php";
include_once "model/Shelf.php";
session_start();
if (!isset($_SESSION['boxes']['loadedFreeShelves'])) { //Checking if we have to refresh the available shelves
    $_SESSION['boxes']['loadFreeShelves'] = true;
    header("Location: controller/freeshelves_controller.php");
}
?>
<section>
    <div class="message">
        <?php if (isset($_SESSION['boxes']['confirm']) && isset($_SESSION['boxes']['loadedFreeShelves'])) { ?>
            <p style="color:green;font-weight:bold;"><?php echo BOX_CREATED; ?></p>
            <?php
            unset($_SESSION['boxes']['confirm']);
        } else if (isset($_SESSION['boxes']['error']) && isset($_SESSION['boxes']['loadedFreeShelves'])) {
            ?>
            <p><strong style="color:red;"><?php echo BOX_ERROR; ?></strong><br/>
                <?php
                echo BOX_ERROR . "'" . $_SESSION['boxes']['error'] . "'";
                unset($_SESSION['boxes']['error']);
                ?>
            </p>
        <?php } ?>
    </div>
    <div id="form">
        <form action="controller/box_controller.php" method="post">
            <fieldset>
                <legend><?php echo NEW_BOX; ?></legend>
                <div id="boxForm">
                    <fieldset>
                        <legend><?php echo GENERAL; ?></legend>
                        <label for="type"><?php echo TYPE; ?></label>
                        <select name="type" id="type" onChange="setType();">
                            <option value="black_box" selected><?php echo BLACK_BOX; ?></option>
                            <option value="security_box"><?php echo SECURITY_BOX; ?></option>
                            <option value="surprise_box"><?php echo SURPRISE_BOX; ?></option>
                        </select>

                        <label for="shelvesSelect"><?php echo SHELVES; ?></label>                          
                        <select id="shelvesSelect" name="shelves" onLoad="" onChange="loadShelfNumber();" required>
                            <?php foreach ($_SESSION['boxes']['freeshelves'] as $shelves) { ?>
                                <option  value="<?php echo $shelves->getId(); ?>" ><?php echo SHELVES; ?> <?php echo $shelves->getCorridor() . "" . $shelves->getPosition(); ?></option>
                            <?php }
                            ?>
                        </select> 
                        <script type="text/javascript">loadShelfNumber();</script>
                        <label for="shelfNumber"><?php echo FREE_SHELVES; ?></label>
                        <select id="shelfNumber" name="shelfNumber" ></select>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo DIMENSIONS; ?></legend>
                        <label for="boxWidth" ><?php echo WIDTH; ?></label>
                        <input type="number" name="boxWidth" min="0" required />
                        <label for="boxHeight"><?php echo HEIGHT; ?></label>
                        <input type="number" name="boxHeight"  min="0" required />
                        <label for="boxDepth"><?php echo DEPTH; ?></label>
                        <input type="number" name="boxDepth"  min="0" required />
                    </fieldset>
                    <fieldset>
                        <legend>Extra</legend>
                        <label for="boxColor" id="color"><?php echo COLOR; ?> <br>
                            <input type="color" name="boxColor" /></label>

                        <div id="blackbox" >
                            <label for="boxChip"><?php echo CHIP; ?></label>
                            <input type="text" name="boxChip"  />    
                        </div>
                        <div id="securitybox" >
                            <label for="boxLock"><?php echo LOCK; ?></label>
                            <input type="text" name="boxLock" />    
                        </div>
                        <div id="surprisebox" >
                            <label for="boxContent"><?php echo CONTENT; ?></label>
                            <input type="text" name="boxContent" />    
                        </div>

                    </fieldset>
                    <br>
                    <div style="clear:left"></div>
                    <div style="text-align:center;margin:10px;">
                        <button type="submit" /><?php echo SUBMIT; ?></button> 
                        <button type="reset" /><?php echo RESET; ?></button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

</section>
<?php ?>