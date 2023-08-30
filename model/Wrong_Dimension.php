<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estantes_ex
 *
 * @author victo
 */
class Wrong_Dimension extends Exception {
    protected $message;
    protected $code;
    function __construct($message, $code) {
        parent::__construct($message,$code,null);
        $this->message = $message;
        $this->code = $code;
    }
    public function __toString() {
        if($this->code == 1){
            return __CLASS__.": The $this->message is negative";
        }
        else if($this->code == 2){
            return __CLASS__.": The $this->message is higger than permited";
        } 
        else if($this->code == 3){
            return __CLASS__.": The $this->message is wrong";
        } 
        
    }

    
}
