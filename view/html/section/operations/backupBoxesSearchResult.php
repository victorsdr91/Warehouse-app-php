<br/>
<?php if ($box = $_SESSION['operations']['searchBackupBox']) { ?>
<h1 class="header_tab">Box information</h1>
    <table id="bbox_tb" class="inventory_tb">
        <tr>
            <th>ID</th>
            <th>Shelves</th>
            <th>Shelf</th>
            <th>Width</th>
            <th>Height</th>
            <th>Depth</th>
            <th>Color</th>
            <th>Register Date</th>
            <th>Discharge Date</th>
            <th>Chip</th>
        </tr>
        <?php if($box instanceof BlackBox_Backup) {
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "BB" . $box->getId(); ?></td>
                    <td><?php echo $box->getShelvesId(); ?></td>
                    <td><?php echo $box->getShelfId(); ?></td>
                    <td><?php echo $box->getWidth(); ?></td>
                    <td><?php echo$box->getHeight(); ?></td>
                    <td><?php echo$box->getDepth(); ?></td>
                    <td style="background: <?php echo$box->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo$box->getRegister_Date(); ?></td>
                    <td><?php echo$box->getDischargeDate(); ?></td>
                    <td><?php echo$box->getChip(); ?></td>
                </tr>
                <?php 
        }else if($box instanceof SurpriseBox_Backup) {
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "SU" .$box->getId(); ?></td>
                    <td><?php echo $box->getShelvesId(); ?></td>
                    <td><?php echo $box->getShelfId(); ?></td>
                    <td><?php echo$box->getWidth(); ?></td>
                    <td><?php echo$box->getHeight(); ?></td>
                    <td><?php echo$box->getDepth(); ?></td>
                    <td style="background: <?php echo$box->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo$box->getRegister_Date(); ?></td>
                    <td><?php echo$box->getDischargeDate(); ?></td>
                    <td><?php echo$box->getContent(); ?></td>
                </tr>
                <?php 
             }else if($box instanceof SecurityBox_Backup) {
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "SE" .$box->getId(); ?></td>
                    <td><?php echo $box->getShelvesId(); ?></td>
                    <td><?php echo $box->getShelfId(); ?></td>
                    <td><?php echo$box->getWidth(); ?></td>
                    <td><?php echo$box->getHeight(); ?></td>
                    <td><?php echo$box->getDepth(); ?></td>
                    <td style="background: <?php echo$box->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo$box->getRegister_Date(); ?></td>
                    <td><?php echo$box->getDischargeDate(); ?></td>
                    <td><?php echo$box->getLock(); ?></td>
                </tr>
             <?php
             
             }
    ?>
    <?php ?>
    </table> 
    <form action="controller/operations_controller.php" style="text-align:center" method="post">
        <input type="hidden" value="true" name="returnBox" />
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
        <div style="text-align:center;margin:10px;">
                <button type="submit" /><?php echo SUBMIT; ?></button> 
                <button type="reset" /><?php echo RESET; ?></button>
        </div>
    </form>
<?php 
} else {
    echo "The box is not on the database.";
}
unset($_SESSION['operations']['showSearchedBackupBox']);
