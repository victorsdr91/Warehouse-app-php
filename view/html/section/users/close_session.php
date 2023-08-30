<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$is_user = false;
session_unset();
session_destroy();

?>
<section>
    <div class="message">
         <p style="color:green;font-weight:bold;"><?php echo SESSION_CLOSED; ?></p>
        <a href="./"><?php echo GO_INDEX; ?></a>
    </div>
</section>