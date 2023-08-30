<br/>
<?php if ($box = $_SESSION['operations']['searchBox']) { ?>
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
            <th>Chip</th>
        </tr>
        <?php switch ($box['shelf']->getBox_type()) {
            case 'black_box':
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "BB" . $box['box']->getId(); ?></td>
                    <td><?php echo $box['shelf']->getShelves_id(); ?></td>
                    <td><?php echo $box['shelf']->getShelf_id(); ?></td>
                    <td><?php echo $box['box']->getWidth(); ?></td>
                    <td><?php echo $box['box']->getHeight(); ?></td>
                    <td><?php echo $box['box']->getDepth(); ?></td>
                    <td style="background: <?php echo $box['box']->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo $box['box']->getRegister_Date(); ?></td>
                    <td><?php echo $box['box']->getChip(); ?></td>
                </tr>
                <?php break;
            case 'surprise_box':
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "SU" . $box['box']->getId(); ?></td>
                    <td><?php echo $box['shelf']->getShelves_id(); ?></td>
                    <td><?php echo $box['shelf']->getShelf_id(); ?></td>
                    <td><?php echo $box['box']->getWidth(); ?></td>
                    <td><?php echo $box['box']->getHeight(); ?></td>
                    <td><?php echo $box['box']->getDepth(); ?></td>
                    <td style="background: <?php echo $box['box']->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo $box['box']->getRegister_Date(); ?></td>
                    <td><?php echo $box['box']->getContent(); ?></td>
                </tr>
                <?php break;
            case 'security_box':
                ?>
                <tr class="boxes_a" >
                    <td><?php echo "SE" . $box['box']->getId(); ?></td>
                    <td><?php echo $box['shelf']->getShelves_id(); ?></td>
                    <td><?php echo $box['shelf']->getShelf_id(); ?></td>
                    <td><?php echo $box['box']->getWidth(); ?></td>
                    <td><?php echo $box['box']->getHeight(); ?></td>
                    <td><?php echo $box['box']->getDepth(); ?></td>
                    <td style="background: <?php echo $box['box']->getColor(); ?>;padding:10px;"></td>
                    <td><?php echo $box['box']->getRegister_Date(); ?></td>
                    <td><?php echo $box['box']->getLock(); ?></td>
                </tr>
            <?php break;
    }
    ?>


    <?php ?>
    </table> 
    <center><button onClick="location.href='./controller/operations_controller.php?action=boxExit'">Box Exit</button></center>
<?php 
} else {
    echo "The box is not on the database.";
}
unset($_SESSION['operations']['showSearchedBox']);
