<?php
include_once '../model/User.php';
include_once '../dao/users_DAO.php';
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_REQUEST['login'])){
    try{
    $user = users_DAO::getUser($_REQUEST['nick'],$_REQUEST['pass']);
    $_SESSION['user']['data'] = $user ;
    $_SESSION['user']['is_user'] = true;
    }catch(Exception $er){
        $_SESSION['user']['login']['error'] = (String)$er;
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['register_account'])){
    try{
    $pass = password_hash($_REQUEST['pass'], PASSWORD_BCRYPT);    
    $avatar = users_DAO::uploadAvatar($_FILES['avatar'],$_REQUEST['nick']);
    $user = new User(0,$_REQUEST['nick'],$_REQUEST['email'],$pass,$avatar);
    users_DAO::addUser($user);
    header('Location: ../register_confirm.html');
    }catch(Exception $er){
        $_SESSION['user']['register']['error'] = (String)$er;
        header('Location: ../register_error.html');
    }
    
}
else if(isset($_REQUEST['action']) && $_REQUEST['action']=="register"){
    $_SESSION['user']['showRegisterForm'] = true;
     header('Location: '.$_SERVER['HTTP_REFERER']);
    
}