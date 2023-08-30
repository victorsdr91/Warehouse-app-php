<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section id="section" >
    <form action="controller/user_controller.php" method="post" id="register_form" enctype="multipart/form-data">
        <h1 class="header_tab" style="margin-top:0"><?php echo NEW_REGISTER;?></h1>
        <input type="hidden" value="true" name="register_account" />
        <table align="center" style="text-align:left;margin-bottom:15px;">
        <tr>
            <td><label for="nick"><?php echo USER_NICKNAME;?>: </label></td>
            <td><input type="text" name="nick" id="nick" style="width:120px;" placeholder="<?php echo USER_NICKNAME_PLACEHOLDER;?>" required/> </td>
        </tr>
         <tr>
           <td><label for="pass"><?php echo USER_PASSWORD;?>: </label> </td>
            <td><input type="password" name="pass" id="pass" style="width:120px;" placeholder="<?php echo USER_PASSWORD_PLACEHOLDER;?>" required/> </td>
        </tr>
        <tr>
           <td><label for="passC"><?php echo USER_PASSWORD_CONFIRM;?>: </label> </td>
            <td><input type="password" name="passC" id="passC" style="width:120px;" placeholder="<?php echo USER_PASSWORD_CONFIRM_PLACEHOLDER;?>" required/> </td>
        </tr>
         <tr>
            <td><label for="email"><?php echo USER_EMAIL;?>: </label></td>
            <td><input type="email" name="email" id="email" style="width:150px;" placeholder="<?php echo USER_EMAIL_PLACEHOLDER;?>" required/> </td>
        </tr>
         <tr>
            <td><label for="avatar"><?php echo USER_AVATAR;?>: </label></td>
            <td><input type="file" name="avatar" id="avatar" style="width:300px;" required/> </td>
        </tr>
        </table>
        <button type="submit"><?php echo SUBMIT; ?></button> <button type="reset"><?php echo RESET; ?></button>
    </form>
    
</section>
<?php unset($_SESSION['user']['showRegisterForm']);