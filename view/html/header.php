<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Warehouse App</title>
        <link rel="stylesheet" type="text/css" href="./view/css/style.css" />
        <script type="text/javascript" src="./view/js/script.js"></script>
</head>
<body>  <header>
            <a href="./">
            <img src="./view/img/logo.png" id="logo" alt="WareHouse App"/> 
           <h1><span style="color: #3f8e8e">W</span>arehouse <span style="color: #3f8e8e">A</span>pp</h1></a>
            <div id="lang">
				<a href="index.php?changeLang=es_ES" ><img src="view/img/es.png" class="flag" alt="Español" title="Español" /></a>
				<a href="index.php?changeLang=en_GB" ><img src="view/img/uk.png" class="flag" alt="English" title="English" /></a>
				<div class="clear-left" ></div>
            </div>
            <div style="clear:both"></div>
        </header>
         <nav>
                <a href="./shelves.html"><?php echo ADD_SHELVES; ?></a>
                <a href="./boxes.html"><?php echo ADD_BOXES; ?></a>
                <a href="./operations.html"><?php echo OPERATIONS; ?></a>
                <?php if($is_user){ ?>
                <div  style='float:right;position:relative; top:-4px;' >
                    <a href='#' style="float:left;padding:2px;"><img src="./view/img/users/avatar/<?php echo $user_data->getAvatar(); ?>" alt="Avatar"  style="width:25px; border-radius:3px; display:inline; float:left; " /> 
                        <span style="float:left;margin-left: 5px;margin-top:2px;"><?php echo $user_data->getNick(); ?></span></a>
                    <a href='./close_session.html' style="float:left;padding:4px;margin-right:10px;"><img src='./view/img/close_session.png' style="width:17px; display:inline;" title="<?php echo CLOSE_SESSION; ?>" alt="<?php echo CLOSE_SESSION; ?>" /></a>
                    <div style="clear:left"></div>
                </div>
                <div style="clear:right"></div>
                <?php } ?>
        </nav>
