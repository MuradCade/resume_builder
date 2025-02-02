<?php
include('config.php');

$connection = new mysqli(servername,username,password,databasename);

if(!$connection){
    echo 'connection failed';
}
