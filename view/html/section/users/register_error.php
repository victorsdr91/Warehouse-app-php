<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section>
    <div class="message">
        <?php echo REGISTER_ERROR.$_SESSION['user']['register']['error']; ?><br/>
        <a href="javascript:history.back(1);"><?php echo GO_BACK; ?></a>
    </div>
</section>