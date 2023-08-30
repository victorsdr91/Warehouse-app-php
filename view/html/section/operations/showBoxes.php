<br/>
<label for="typeSelect" style="text-align:center;"><?php echo TYPE; ?> <select id="typeSelect" onChange="showTable();" name="typeSelect">
        <option value="all"><?php echo ALL; ?></option>
        <option value="blackbox"><?php echo BLACK_BOX; ?></option>
        <option value="surprisebox"><?php echo SURPRISE_BOX; ?></option>
        <option value="securitybox"><?php echo SECURITY_BOX; ?></option>
    </select>
</label>
<div class="message">
    <h1 class="header_tab" id="boxtype_header"><?php echo ALL_BOXES; ?></h1>
    <?php
    $boxes = $_SESSION['operations']['boxes'];
    include_once './view/html/section/operations/showBlackBoxes.php';
    include_once './view/html/section/operations/showSurpriseBoxes.php';
    include_once './view/html/section/operations/showSecurityBoxes.php';
    ?>    

    <?php
    unset($_SESSION['operations']['boxes']);
    unset($_SESSION['operations']['boxesType']);
    ?>
</div>