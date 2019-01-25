<?php
$db = new mysqli('localhost','pranpwja_mehedipost','@lock234P','pranpwja_mehedipost');
if($db->connect_error){
    die('database are not connected').mysqli_errno();
}else{
    return $db;
}