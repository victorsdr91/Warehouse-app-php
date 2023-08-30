
<section style="width:73%;float:left;" id='section'>
    <div class="message">
        <?php
        session_start();
        if (isset($_SESSION['shelves']['confirm'])) {
            ?>
            <p style="color:green;font-weight:bold;"><?php echo SHELVES_CREATED; ?></p>
            <?php
            unset($_SESSION['shelves']['confirm']);
        }
        ?>
            <?php if (isset($_SESSION['shelves']['error'])) { ?>
            <p><strong style="color:red;"><?php echo SHELVES_ERROR; ?></strong><br/>
            <?php echo MESSAGE."'" . $_SESSION['shelves']['error'] . "'";
            unset($_SESSION['shelves']['error']);
            ?>
            </p>
<?php } ?>
    </div>
      <div style="width:30%;float:left;text-align:center;margin-top:15px">
        <img src="./view/img/shelves.png" alt="Shelves" style="width: 250px;margin:auto"/>
    </div>
    <form action="./controller/shelves_controller.php" method="post" style="width:70%;float:left">
        <fieldset style="padding:15px;">
            <legend><?php echo NEW_SHELVES; ?></legend>
            <label for="nshelf"><?php echo SHELVES_NUMBER; ?></label>
            <input type="number" min="1" max="99" name="nshelf" required/>
            <label for="material" ><?php echo MATERIAL; ?></label>
            <input type="text" name="material" required/>
            <label for="corridor"><?php echo CORRIDOR; ?></label>
            <input type="text" name="corridor" required/>
            <label for="position"><?php echo POSITION; ?></label>
            <input type="text" name="position" required/>
            <br><br>
            <button type="submit" /><?php echo SUBMIT; ?></button> 
            <button type="reset" /><?php echo RESET; ?></button>
        </fieldset> 
    </form>
  
    <div style="clear:left;"></div>
</section>
<aside style="width:25.8%;float:left;display:block;" id='aside' >
    <h2><?php echo OTHER_ACTIONS; ?></h2>
    <a class="aside_a" href="./controller/operations_controller.php?operation=showShelves"><?php echo SHOW_SHELVES; ?></a>
    <a class="aside_a" href="./controller/operations_controller.php?operation=showInventory"><?php echo SHOW_INVENTORY; ?></a>
</aside>
<div style="clear:left;"></div>
<script>if(document.getElementById('section').clientHeight >= document.getElementById('aside').clientHeight) document.getElementById('aside').style.height = (document.getElementById('section').clientHeight+1)+"px";
        else document.getElementById('section').style.height = (document.getElementById('aside').clientHeight+1)+"px";

</script>
