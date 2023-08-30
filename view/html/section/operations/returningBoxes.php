
    <div id="form" style="text-align:center;">
        <h1 class="header_tab">Return a box - Search</h1>
        <form class="operation_form" action="./controller/operations_controller.php" method="post">
            <input type="hidden" value="true" name="searchBackupBox" />
            <label for="id"><?php echo CODE; ?>
            <input type="number" name="id" min="0" style="width:50px;" required/>
            
            <select name="type" id="type" onChange="setType();" required>
                <option value="black_box" selected><?php echo BLACK_BOX; ?></option>
                <option value="security_box"><?php echo SECURITY_BOX; ?></option>
                <option value="surprise_box"><?php echo SURPRISE_BOX; ?></option>
            </select>
            <button type="submit"/><?php echo SUBMIT; ?></button> </label>
    </form>
    </div>

<?php unset($_SESSION['operations']['returnBox']); ?>

