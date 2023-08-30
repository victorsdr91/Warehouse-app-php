<div class="message">
    <?php
    //print_r ($_SESSION['operations']['shelves']);
    $shelves = $_SESSION['operations']['shelves'];
    ?>  
    <h1 class="header_tab">Inventory - Shelves</h1>
    <table class="inventory_tb">
        <tr >
             
            <th><?php echo CORRIDOR; ?></th>
            <th><?php echo POSITION; ?></th>
            <th>ID</th>
            <th><?php echo SHELVES_NUMBER; ?></th>
            <th><?php echo OCCUPIED; ?></th>
            <th><?php echo MATERIAL; ?></th>
           
        </tr>
        <?php foreach ($shelves as $shelf) { ?>
            <tr class="shelves_a">
                <td><?php echo $shelf->getCorridor(); ?></td>
                <td><?php echo $shelf->getPosition(); ?></td>
                <td><?php echo $shelf->getId(); ?></td>
                <td><?php echo $shelf->getNshelves(); ?></td>
                <td><?php echo $shelf->getOccupied(); ?></td>
                <td><?php echo $shelf->getMaterial(); ?></td>
             
            </tr>
        <?php } ?>
    </table> 
    <?php
    unset($_SESSION['operations']['shelves']);
    ?>
</div>

