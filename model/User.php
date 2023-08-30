<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author victo
 */
class User {
    private $userId;
    private $nick;
    private $email;
    private $password;
    private $avatar;
    
    function __construct($userId, $nick, $email, $password, $avatar) {
        $this->userId = $userId;
        $this->nick = $nick;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
    }
    function getUserId() {
        return $this->userId;
    }

    function getNick() {
        return $this->nick;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getAvatar() {
        return $this->avatar;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

}
