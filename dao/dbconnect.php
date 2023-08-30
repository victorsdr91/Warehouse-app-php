<?php

$connect = new mysqli("localhost", "root", "root", "db_warehouse");
if($connect->connect_error != null){
    echo "Connection error: $connect->connect_error";
    exit();
}