<?php
 include_once '/dao/users_DAO.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<section id="section" >
    <div class="message">
        <?php  if (isset($_SESSION['user']['login']['error'])) {
            ?>
            <p><strong style="color:red;"><?php echo LOGIN_ERROR; ?></strong><br/>
                <?php
                echo "'" . $_SESSION['user']['login']['error'] . "'";
                unset($_SESSION['user']['login']['error']);
                ?>
            </p>
        <?php } ?>
    </div>
    <form action="controller/user_controller.php" method="post" id="login_form">
        <h1 class="header_tab" style="margin-top:0"><?php echo LOGIN;?></h1>
       <?php echo (String)$is_user; ?>
        <input type="hidden" value="true" name="login" />
        <table align="center" style="text-align:left;">
        <tr>
            <td><label for="nick"><?php echo USER_NICKNAME;?>: </label></td>
            <td><input type="text" name="nick" id="nick" style="width:120px;" placeholder="<?php echo USER_NICKNAME_PLACEHOLDER;?>" required/> </td>
        </tr>
         <tr>
           <td><label for="pass"><?php echo USER_PASSWORD;?>: </label> </td>
            <td><input type="password" name="pass" id="pass" style="width:120px;" placeholder="<?php echo USER_PASSWORD_PLACEHOLDER;?>" required/> </td>
        </tr>
        </table>
        <!-- Si hay usuarios en la base de datos no permite crear mas cuentas. -->
         <a href="#" style="font-size:14px;"><?php echo FORGOT_PASS;?></a> <?php echo (users_DAO::howManyUsers()==0) ? "| <a href='controller/user_controller.php?action=register' style='font-size:14px;' >".REGISTER_ACCOUNT."</a>" : ""; ?>
        <br><br>
        <button type="submit"><?php echo SUBMIT; ?></button>
    </form>
    
</section>