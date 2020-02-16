<?php

$server_name="localhost";
$db_username="root";
$db_password="";

   try{
       $conn=new PDO("mysql:host=$server_name;dbname=oop_db",$db_username,$db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
       $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

   }catch (PDOException $e){
       echo "Connection failed:".$e->getMessage();
   }

?>

