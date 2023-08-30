<?php
//Constant to know if we are loading a file from the index.php or not.
define("root",true); 

//Variable to know if the user is logged or not.
$is_user = false;
include_once 'model/User.php'; //We should include the user model to let the system to use the $user_data variable that contains the user object.
session_start();

if(isset($_SESSION['user']['is_user'])){
    $is_user = true;
    $user_data = $_SESSION['user']['data']; //We should save the user's data on this global variable to use it without start the session.
}
session_write_close();


/* Loading the view */

/* Loading the language file */
$lang = 'en_GB';
if(isset($_REQUEST['changeLang'])){
    setcookie("lang", $_REQUEST['changeLang'], time()+(3600*24));
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
if(isset($_COOKIE['lang'])){ 
    $lang = $_COOKIE['lang']; 
}
include_once "lang/$lang.php";


include_once 'view/html/header.php';
if(!$is_user){
    session_start();
    if(isset($_SESSION['user']['showRegisterForm'])){
        include_once 'view/html/section/users/register.php';
    }
    else if(isset($_REQUEST['section'])){
        switch($_REQUEST['section']){
            case 'register_confirm':
                include_once 'view/html/section/users/register_confirm.php';
                break;
            case 'register_error':
                include_once 'view/html/section/users/register_error.php';
                break;
            default:
                include_once 'view/html/section/users/login.php';
        }
    }
    else include_once 'view/html/section/users/login.php';
}
else{
    if(isset($_REQUEST['section'])){
        switch($_REQUEST['section']){
            case 'boxes':
                include_once 'view/html/section/boxes/boxes.php';
                break;
            case 'operations':
                include_once 'view/html/section/operations/operations.php';
                break;
             case 'close_session':
                include_once 'view/html/section/users/close_session.php';
                break;
            case 'shelves':
                include_once 'view/html/section/shelves/shelves.php';
        }
    }
    else{
        include_once 'view/html/section/shelves/shelves.php';
    }
}

include_once 'view/html/footer.html';

