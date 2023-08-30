<h1 class="header_tab" id="subox_head"><?php echo SURPRISE_BOXES ?></h1>
<?php if (isset($boxes['surprise'])) { ?>
    <table id="subox_tb" class="inventory_tb">
        <tr>
            <th>ID</th>
            <th><?php echo SHELVES; ?></th>
            <th><?php echo SHELF; ?></th>
            <th><?php echo WIDTH; ?></th>
            <th><?php echo HEIGHT; ?></th>
            <th><?php echo DEPTH; ?></th>
            <th><?php echo COLOR; ?></th>
            <th><?php echo REGISTER_DATE; ?></th>
            <th><?php echo CONTENT; ?></th>
        </tr>
        <?php foreach ($boxes['surprise'] as $box) { ?>
            <tr class="boxes_a">
                <td><?php echo "SUB" . $box['box']->getId(); ?></td>
                <td><?php echo $box['shelf']->getShelves_id(); ?></td>
                <td><?php echo $box['shelf']->getShelf_id(); ?></td>
                <td><?php echo $box['box']->getWidth(); ?></td>
                <td><?php echo $box['box']->getHeight(); ?></td>
                <td><?php echo $box['box']->getDepth(); ?></td>
                <td style="background: <?php echo $box['box']->getColor(); ?>;padding:10px;"></td>
                <td><?php echo $box['box']->getRegister_Date(); ?></td>
                <td><?php echo $box['box']->getContent(); ?></td>
            </tr>

        <?php } ?>
    </table> 
    <?php
} else {
    echo "There aren't surprise boxes yet.";
}
    