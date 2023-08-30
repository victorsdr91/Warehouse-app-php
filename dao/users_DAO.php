<?php
include_once 'dbconnect.php';
include_once 'Dao_Exception.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users_DAO
 *
 * @author victo
 */
class users_DAO {
    
    public function howManyUsers(){
         global $connect;
        $select = "SELECT * FROM users ";
        $result= $connect->query($select);
        $cont = 0;
        while($row_user = $result->fetch_object()){
            $cont++;
        }
        
        return $cont;
    }
    
    public function uploadAvatar($img,$nick){
        $img_type=$img['type'];
        $img_name='';
        $uploaddir = '../view/img/users/avatar/';
        if($img['size'] != 0){
            switch($img_type){
                case 'image/gif': $avatar_name = $nick.'.gif';
                    break;
                case 'image/jpeg': $avatar_name = $nick.'.jpeg';
                    break;
                case 'image/jpg': $avatar_name = $nick.'.jpg';
                    break;
                case 'image/png': $avatar_name = $nick.'.png';
                    break;
                default: throw new Exception(NOT_VALID_IMAGE);
            }
            $uploadfile = $uploaddir.$avatar_name;
            if(file_exists($uploadfile)) unlink($uploadfile);
            if (move_uploaded_file($img['tmp_name'], $uploadfile)) return $avatar_name;
            else return null;
	}
    }
    
    public function getUser($nick, $pass){
        global $connect;
        $select_user = "SELECT * FROM users WHERE nickname='$nick'";
        $result= $connect->query($select_user);
        if($result){
            $row_user = $result->fetch_object();
            $user = new User($row_user->ID,$row_user->NICKNAME, $row_user->EMAIL, $row_user->PASSWORD, $row_user->AVATAR );
        }else throw new Exception("Incorrect user.");
        if(password_verify($pass, $row_user->PASSWORD))
            return $user;
        else throw new Exception("Incorrect password.");
    }
    
    public function addUser($user){
        global $connect;
        if($user instanceof User){
             $insert_user = "INSERT INTO users VALUES(null,'".$user->getNick()."','".$user->getPassword()."','".$user->getEmail()."','".$user->getAvatar()."')";
             $result = $connect->query($insert_user);
             if(!$result) throw new Exception("Error on the insert of user at the database");
        }         
    }
}
