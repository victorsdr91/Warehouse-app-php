<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this temchip file, choose Tools | Temchips
 * and open the temchip in the editor.
 */

/**
 * Description of CajaNegra
 *
 * @author victo
 */
include_once 'SurpriseBox.php';
class SurpriseBox_Backup extends SurpriseBox {
     private $dischargeDate;
     private $shelvesId;
     private $shelfId;
    
     public function __construct($id,$height,$width,$depth,$color,$register_date,$content, $dischargeDate,$shelvesId,$shelfId) {
         parent::__construct($id,$height,$width,$depth,$color,$register_date,$content);
         $this->dischargeDate = $dischargeDate;
         $this->shelvesId = $shelvesId;
         $this->shelfId = $shelfId;
     }
     function getDischargeDate() {
         return $this->dischargeDate;
     }

     function getShelvesId() {
         return $this->shelvesId;
     }

     function getShelfId() {
         return $this->shelfId;
     }

     function setDischargeDate($dischargeDate) {
         $this->dischargeDate = $dischargeDate;
     }

     function setShelvesId($shelvesId) {
         $this->shelvesId = $shelvesId;
     }

     function setShelfId($shelfId) {
         $this->shelfId = $shelfId;
     }   

}
