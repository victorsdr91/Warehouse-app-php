<h1 class="header_tab" style="text-align:center;">Inventory - [<?php echo $_SESSION['operations']['inventory']->getDate(); ?>]</h1>

<?php
$corridor = null;
?>
<div id="inv_index" style="text-align:center;"> <strong>Index:</strong> 
    <?php
    foreach ($_SESSION['operations']['inventory']->getShelves() as $shelves) {
        if ($shelves->getCorridor() != $corridor) {
            ?>
            | <a  style="text-decoration:none;font-weight:bold;" href="#corridor_<?php echo $shelves->getCorridor(); ?>"><?php echo $shelves->getCorridor(); ?></a> |<?php
            $corridor = $shelves->getCorridor();
        }
    }
    ?>
</div>
<?php
$corridor = null;
foreach ($_SESSION['operations']['inventory']->getShelves() as $shelves) {
    ?>
    
        <?php if ($shelves->getCorridor() != $corridor) { ?>
        <table class="inventory_tb" style="width:90%;margin:2px auto;">
            <thead>
            <th id="<?php echo "corridor_" . $shelves->getCorridor(); ?>" style="background: #003333;font-size:24px;"><?php echo CORRIDOR." ".$shelves->getCorridor(); ?></th>
            </thead>
          </table>
        <?php
        $corridor = $shelves->getCorridor();
    }
    ?>
  
    <table class="inventory_tb" style="width:90%;">
    <tr class="thead">
       
        <th colspan="3" style="background: rgba(10,20,20,0.4);font-size:18px;"><?php echo SHELVES; ?> <?php echo $shelves->getId(); ?></th>
         <th colspan="2"  rowspan="2" style="background: rgba(10,20,20,0.9);"><?php echo POSITION; ?>: <?php echo $shelves->getPosition(); ?></th>
        <th colspan="3" rowspan="2" style="background: rgba(10,20,20,0.9);"><?php echo SHELVES_NUMBER; ?>: <?php echo $shelves->getNshelves(); ?> </th>
    </tr>
    <tr >        
        <th colspan="3" style="background: rgba(10,20,20,0.9);"><?php echo MATERIAL; ?>: <?php echo $shelves->getMaterial(); ?></th>
    </tr>
    <tr>
        <th>ID</th>
        <th><?php echo SHELF;?></th>
        <th><?php echo WIDTH;?></th>
        <th><?php echo HEIGHT;?></th>
        <th><?php echo DEPTH;?></th>
        <th><?php echo COLOR;?></th>
        <th><?php echo REGISTER_DATE;?></th>
        <th>Extra</th>
    </tr>
    <?php
    $null = true;
    foreach ($shelves->getBoxes() as $ind => $box) {
        if($box instanceof Box){
            $null=false;
        ?>
        <tr class="boxes_a" >
            <?php
            if ($box instanceof BlackBox) {
                ?>
                <td><strong><?php echo "BB" . $box->getId(); ?></strong></td>
                <td><?php echo $ind; ?></td>
                <td><?php echo $box->getWidth(); ?></td>
                <td><?php echo $box->getHeight(); ?></td>
                <td><?php echo $box->getDepth(); ?></td>
                <td style="background: <?php echo $box->getColor(); ?>;padding:10px;"></td>
                <td><?php echo $box->getRegister_date(); ?></td>
                <td><strong><?php echo CHIP; ?>:</strong> <?php echo $box->getChip(); ?></td>
            <?php
            } else if ($box instanceof SurpriseBox) {
                ?>
                <td><strong><?php echo "SUB" . $box->getId(); ?></strong></td>
                <td><?php echo $ind; ?></td>
                <td><?php echo $box->getWidth(); ?></td>
                <td><?php echo $box->getHeight(); ?></td>
                <td><?php echo $box->getDepth(); ?></td>
                <td style="background: <?php echo $box->getColor(); ?>;padding:10px;"></td>
               <td><?php echo $box->getRegister_date(); ?></td>
                <td><strong><?php echo CONTENT; ?>:</strong> <?php echo $box->getContent(); ?></td>
            <?php
            } else if ($box instanceof SecurityBox) {
                ?>
                <td><strong><?php echo "SEB" . $box->getId(); ?></strong></td>
                <td><?php echo $ind; ?></td>
                <td><?php echo $box->getWidth(); ?></td>
                <td><?php echo $box->getHeight(); ?></td>
                <td><?php echo $box->getDepth(); ?></td>
                <td style="background: <?php echo $box->getColor(); ?>;padding:10px;"></td>
                <td><?php echo $box->getRegister_date(); ?></td>
                <td><strong><?php echo LOCK; ?>:</strong> <?php echo $box->getLock(); ?></td>
        <?php } ?>
        </tr>
        <?php }
    } if ($null) {
        ?>
        <tr><td colspan="8" style="background:#ff3333;font-weight:bold;"><?php echo NOT_BOXES_ON_SHELVES; ?></td></tr>
        <?php
    }
}
?>
</table>
<?php
unset($_SESSION['operations']['inventory']);
